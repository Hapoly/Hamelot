<?php

namespace App\Models;

use App\UModel;
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
        return __('transactions.status_str.' . $this->staus);
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

    
}
