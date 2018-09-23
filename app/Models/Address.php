<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Address extends Model
{
    protected $primary = 'id';
    protected $table = 'addresses';
    protected $fillable = ['title', 'plain', 'lon', 'lat', 'city_id', 'user_id'];

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function fetch(){
        if(Auth::user()->isAdmin())
            return new Address;
        else
            return Auth::user()->addresses();
    }
}
