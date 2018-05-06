<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalUser extends Model
{
    protected $primary = 'id';
    protected $table = 'hospital_users';
    protected $fillable = ['hospital_id', 'user_id'];

    public function hospital(){
        return $this->belongsToMany('App\Models\Hospital');
    }
    public function user(){
        return $this->belongsToMany('App\User');
    }
}
