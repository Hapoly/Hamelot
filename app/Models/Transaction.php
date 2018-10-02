<?php

namespace App\Models;

use App\UModel;
use App\Drivers\Time;
use Auth;

class Transaction extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'transactions';
    protected $fillable = ['type', 'amount', 'src_id', 'dst_id', 'target', 'pay_type', 'authority', 'currency', 'status', 'date'];

    const BID_DEPOSIT_PAY   = 1;
    const BID_DEPOSIT_BACK  = 2;
    const BID_REMAIN_PAY    = 3;
    const BID_RMAIN_BACK    = 4;
    const WITHDRAW          = 5;
    public function getTypeStrAttribute(){
        return __('transactions.type_str.' . $this->type);
    }

    const ONLINE_PAY    = 1;
    const OFFLINE_PAY   = 2;
    public function getPayTypeStrAttribute(){
        return __('transactions.pay_type_str.' . $this->pay_type);
    }

    public function source(){
        switch($this->type){
            case Transaction::BID_DEPOSIT_PAY:
                return $this->belongsTo('App\User');
            case Transaction::BID_DEPOSIT_BACK:
                return $this->belongsTo('App\Models\Unit');
            case Transaction::BID_DEPOSIT_PAY:
                return $this->belongsTo('App\User');
            case Transaction::BID_DEPOSIT_BACK:
                return $this->belongsTo('App\Models\Unit');
        }
    }
    public function destination(){
        switch($this->type){
            case Transaction::BID_DEPOSIT_PAY:
                return $this->belongsTo('App\Models\Unit');
            case Transaction::BID_DEPOSIT_BACK:
                return $this->belongsTo('App\User');
            case Transaction::BID_DEPOSIT_PAY:
                return $this->belongsTo('App\Models\Unit');
            case Transaction::BID_DEPOSIT_BACK:
                return $this->belongsTo('App\User');
        }
    }

    public function bid(){
        return $this->belongsTo('App\Models\Bid', 'target');
    }


    const PENDING   = 1;
    const PAID      = 2;
    const FAILED    = 3;
    public function getStatusStrAttribute(){
        return __('transactions.status_str.' . $this->status);
    }

    public static function fetch(){
        $user = Auth::user();
        if($user->isAdmin())
            return new Transaction;
        else if($user->isManager()){
            return Transaction::whereHas('src_unit', function($query) use ($user){
                return $query->managers()->where('users.id', $user->id);
            })->orWhereHas('dst_unit', function($query) use ($user){
                return $query->managers()->where('users.id', $user->id);
            });
        }else{
            return Transaction::where('src_id', $user->id)->orWhere('dst_id', $user->id);
        }
    }

    public function getAmountStrAttribute(){
        return $this->amount . ' ' . __('general.' . $this->currency);
    }

    public function getDateStrAttribute(){
        return Time::jdate('i:H - d F Y', $this->date);
    }

    public function getDescriptionAttribute(){
        $user = Auth::user();
        if( $this->type == Transaction::BID_DEPOSIT_PAY     ||
            $this->type == Transaction::BID_DEPOSIT_BACK    ||
            $this->type == Transaction::BID_REMAIN_PAY      ||
            $this->type == Transaction::BID_RMAIN_BACK){
            if($user->isAdmin()){
                return $this->bid->demand->description . ' ('. $this->bid->demand->patient->full_name .')' . ' - ' . $this->bid->demand->unit->complete_title;
            }else if($user->isPatient()){
                return $this->bid->demand->description;
            }else{
                return $this->bid->demand->description . ' ('. $this->bid->demand->patient->full_name .')';
            }
        }else if($this->type == Transaction::WITHDRAW){
            return ' - ';
        }
    }

    
}
