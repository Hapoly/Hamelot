<?php

namespace App\Models;

use App\UModel;
use Auth;


class Address extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'addresses';
    protected $fillable = ['title', 'plain', 'lon', 'lat', 'city_id', 'user_id', 'phone'];

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

    public function getHasPermissionToWriteAttribute(){
        return Auth::user()->isAdmin() || Auth::user()->id == $this->user_id;
    }
}
