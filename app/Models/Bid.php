<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Drivers\Time;

use Auth;

class Bid extends Model
{
    protected $primary = 'id';
    protected $table = 'bids';
    protected $fillable = [
        'demand_id', 
        'unit_id', 'user_id', 
        'description', 
        'status', 'unit_accepted', 'user_accepted', 'patient_accepted',
        'price', 'deposit', 'date' ];

    public function getDescriptionStrAttribute(){
        if($this->description == 'NuLL')
            return ' - ';
        else
            return $this->description;
    }
    
    public function getDescriptionSummaryAttribute(){
        if(strlen($this->description_str) > 25)
            return mb_substr($this->description_str, 0, 30) . '...' ;
        else 
            return $this->description_str;
    }

    const PENDING               = 1;
    
    const PATIENT_ACCEPTED      = 2;
    const UNIT_ACCEPTED         = 3;    
    const UNIT_USER_ACCEPTED    = 4;

    const PATIENT_REFUSED       = 5;
    const UNIT_REFUSED          = 6;
    const UNIT_USER_REFUSED     = 7;

    const ACCEPTED              = 8;
    const REFUSED               = 9;

    const DONE                  = 10;
    const CANCELED              = 11;
    
    public function getStatusStrAttribute(){
        return __('bids.status_str.' . $this->status);
    }

    public function demand(){
        return $this->belongsTo('App\Models\Demand');
    }
    public function unit(){
        return $this->belongsTo('App\Models\Unit');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getPriceStrAttribute(){
        return $this->price . ' ' . __('general.toman');
    }
    public function getDepositStrAttribute(){
        return $this->deposit . ' ' . __('general.toman');
    }

    // date_str
    public function getDateStrAttribute(){
        return Time::jdate('H:i d F Y', $this->date);
    }

    // permission_to_operate_bid
    public function getPermissionToOperateBidAttribute(){
        return $this->status == Bid::PENDING;
    }

    // fetch
    public static function fetch(){
        if(Auth::user()->isDoctor() || Auth::user()->isPatient())
            return Bid::where('user_id', Auth::user()->id);
        else
            return null;
    }

    const P_PENDING     = 0;
    const P_ACCEPTED    = 1;
    const P_REFUSED     = 2;

    // user_accepted_str
    public function getUserAcceptedStrAttribute(){
        return __('bids.acception_str.' . $this->user_accepted);
    }

    // can_modify
    public function getCanModifyAttribute(){
        if($this->status == Bid::PENDING){
            return Auth::user()->isAdmin() || Auth::user()->isManager();
        }else
            return false;
    }

    // finished
    public function getFinishedAttribute(){
        return $this->status == Bid::DONE || $this->status == Bid::CANCELED;
    }

    // experiments
    public function experiments(){
        return $this->hasMany('App\Models\Experiment', 'bid_id');
    }

    // finish
    public function finish(){
        $this->status = Bid::DONE;
        $this->save();
    }
}