<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\models\Bid;
use App\models\Transaction;

use App\Drivers\Time;

use Auth;

class Demand extends Model
{
    protected $primary = 'id';
    protected $table = 'demands';
    protected $fillable = ['description', 'patient_id', 'address_id', 'status', 'unit_id', 'user_id', 'start_time', 'end_time', 'asap'];

    public function patient(){
        return $this->belongsTo('App\User', 'patient_id');
    }

    /**
     * if address_id wasn't zero them this demand type is on-site service
     */
    public function address(){
        return $this->belongsTo('App\Models\Address');
    }

    const ON_SITE = 1;
    const ON_SPOT = 2;
    public function getTypeAttribute(){
        if($this->Address == 0)
            return Demand::ON_SPOT;
        else
            return Demand::ON_SITE;
    }
    public function getTypeStrAttribute(){
        return __('demands.types_str.' . $this->type);
    }

    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function choosenBid(){
        return $this->bids()->where('status', Bid::ACCEPTED)->first();
    }

    public function bids(){
        return $this->hasMany('App\Models\Bid', 'demand_id');
    }

    public function my_bids(){
        if(Auth::user()->isAdmin() || Auth::user()->isPatient())
            return $this->bids();
        else if(Auth::user()->isManager())
            return $this->hasMany('App\Models\Bid', 'demand_id')->whereHas('unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            });
        else
            return $this->hasMany('App\Models\Bid', 'demand_id')->whereHas('unit', function($query){
                return $query->whereHas('members', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            });
    }

    const FREE_DEMAND           = 1;
    const UNIT_DEMAND           = 2;
    const UNIT_USER_DEMAND      = 3;
    const BID_ACCEPTED          = 4;
    const NO_BID_FOUND          = 5;
    const USER_ASSIGNED         = 6;
    const UNIT_REFUSED          = 7;
    const USER_REFUSED          = 8;
    const USER_ACCEPTED         = 9;
    const DEPOSIT_PAY           = 10;
    const IN_PROGRESS           = 11;
    const PATIENT_CENCELED      = 12;
    const UNIT_USER_CANCELED    = 13;
    const CANCELED              = 14;
    const DONE                  = 15;

    public function getStatusStrAttribute(){
        return __('demands.status_str.' . $this->status);
    }

    public function getDescriptionSummaryAttribute(){
        return mb_substr($this->description, 0, 30) . '...' ;
    }

    public function has_bids(){
        $user = Auth::user();
        if($user->isAdmin() || $user->isPatient())
            return false;
        if($user->isManager() && $this->unit_id)
            return $this->unit->managers()->where('users.id', $user->id)->first();
        return $this->user_id == $user->id;
    }

    /**
     * type:
     *  1   -> free demands
     *  2   -> my accepted demands
     *  3   -> demands to me
     */
    public static function fetch($type = 1){
        if(Auth::user()->isPatient())
            return Demand::where('patient_id', Auth::user()->id);
        else
            return new Demand;
    }

    // has_permission_to_bid
    public function getHasPermissionToBidAttribute(){
        return Auth::user()->isManager();
    }
    // has_permission_to_read_bids
    public function getHasPermissionToReadBidsAttribute(){
        return Auth::user()->isAdmin() || Auth::user()->id == $this->patient_id || $this->has_bids();
    }

    // start_date_time_str
    public function getStartDateTimeStrAttribute(){
        return Time::jdate('H:i d F Y', $this->start_time);
    }
    // end_date_time_str
    public function getEndDateTimeStrAttribute(){
        return Time::jdate('H:i d F Y', $this->end_time);
    }

    // can_modify
    public function getCanModifyAttribute(){
        if(!$this->pending())
            return false;
        if(Auth::user()->isAdmin()){
            return true;
        }else{
            return Auth::user()->id == $this->patient_id;
        }
        return false;
    }

    public function pending(){
        return $this->status == Demand::FREE_DEMAND || $this->status == Demand::UNIT_DEMAND || $this->status == Demand::UNIT_USER_DEMAND;
    }

    public function acceptBid(Bid $bid){
        $bid->status = Bid::ACCEPTED;
        $bid->save();
        $this->status = Demand::IN_PROGRESS;
        $this->unit_id = $bid->unit_id;
        $this->user_id = $bid->user_id;
        $this->save();
        foreach($this->bids as $bid){
            if($bid->status != Bid::ACCEPTED && $bid->status != Bid::DONE && $bid->status != Bid::CANCELED){
                $bid->status = Bid::REFUSED;
                $bid->save();
            }
        }
    }
}
