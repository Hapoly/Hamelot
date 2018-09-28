<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\models\Bid;

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
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function choosenBid(){
        return $this->bids()->where('status', Bid::ACCEPTED)->first();
    }

    public function bids(){
        return $this->hasMany('App\Models\Bid', 'demand_id');
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
        return substr($this->description, 0, 30) . '...';
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
}
