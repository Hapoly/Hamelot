<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Drivers\Time;

use Auth;

class Bid extends Model
{
    protected $primary = 'id';
    protected $table = 'bids';
    protected $fillable = ['demand_id', 'unit_id', 'user_id', 'description', 'status', 'price', 'deposit', 'date'];

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
        switch($this->status){
            case Bid::PENDING:
                return Auth::user()->isAdmin() || $this->demand->patient_id == Auth::user()->id;
            case Bid::PATIENT_ACCEPTED:
                return Auth::user()->isAdmin() || $this->unit->managers()->where('users.id', Auth::user()->id);
            case Bid::UNIT_ACCEPTED:
                return Auth::user()->isAdmin() || $this->unit->managers()->where('users.id', Auth::user()->id) || $this->user_id == Auth::user()->id;
            case Bid::UNIT_USER_ACCEPTED:
                return Auth::user()->id == $this->demand->patient_id;
            default:
                return false;
        }
    }
}