<?php

namespace App\Models;

use App\UModel;


use App\Models\Bid;
use App\Models\Transaction;
use App\Models\Permission;
use App\Drivers\Time;

use Auth;

class Demand extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
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
        $user = Auth::user();
        if($user->isAdmin())
            return $this->bids();
        else if($user->isPatient())
            return $this->bids()->where('patient_accepted', 1)->orWhere([
                ['unit_accepted', 1],
                ['user_accepted', 1],
            ]);
        else if($user->isManager())
            return $this->hasMany('App\Models\Bid', 'demand_id')->whereHas('unit', function($query) use ($user){
                return $query->whereHas('managers', function($query) use ($user){
                    return $query->where('users.id', $user->id);
                });
            });
        else
            return $this->hasMany('App\Models\Bid', 'demand_id')->whereHas('unit', function($query) use ($user){
                return $query->whereHas('members', function($query) use ($user){
                    return $query->where('users.id', $user->id);
                });
            })->where('user_id', $user->id);
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
        $user = Auth::user();
        if($this->pending() && $user->isManager())
            return true;
        if($this->status == Demand::DONE){
            if($this->user_id == $user->id || $this->unit->managers()->where('users.id', $user->id)->first())
                return true;
        }
        return false;
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
        Permission::create([
            'requester_id'  => $this->user_id,
            'patient_id'    => $this->patient_id,
            'status'        => Permission::ACCEPTED,
        ]);
        Transaction::create([
            'src_id'    => $bid->demand->patient_id,
            'dst_id'    => $bid->unit_id,
            'amount'    => $bid->price - $bid->deposit,
            'type'      => Transaction::BID_REMAIN_PAY,
            'status'    => Transaction::PENDING,
            'pay_type'  => Transaction::OFFLINE_PAY,
            'authority' => 'NuLL',
            'currency'  => 'tmn',
            'target'    => $bid->id,
            'date'      => $bid->date,
        ]);
    }
}
