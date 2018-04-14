<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $primary = 'id';
    protected $table = 'hospitals';
    protected $fillable = ['title', 'address', 'phone', 'mobile', 'image', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function status_str(){
        return __('hospitals.status_str.' . $this->status);
    }
    public function users(){
        return $this->hasMany('App\Models\HospitalUser');
    }
    public function departments(){
        return $this->hasMany('App\Models\Department');
    }
    public function reports(){
        return $this->hasMany('App\Models\Reports');
    }
}
