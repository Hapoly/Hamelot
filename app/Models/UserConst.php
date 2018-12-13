<?php

namespace App\Models;

use App\UModel;
use Illuminate\Support\Facades\DB;

use Auth;

class UserConst extends UModel{
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'user_consts';
    protected $fillable = ['user_id', 'const_id'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function const(){
        return $this->belongsTo('App\Models\ConstValue', 'const_id');
    }
}
