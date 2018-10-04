<?php

namespace App\Models;

use App\UModel;
use Auth;
class BankAccount extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'bank_accounts';
    protected $fillable = [ 'title', 'account_number', 'card_number', 'sheba_number', 'bank', 'unit_id', 'owner_name' ];

    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public function getBankTitleAttribute(){
        return __('bank_accounts.banks.' . $this->bank);
    }

    public static function fetch(){
        if(Auth::user()->isAdmin())
            return new BankAccount;
        else
            return BankAccount::whereHas('unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            });
    }
}
