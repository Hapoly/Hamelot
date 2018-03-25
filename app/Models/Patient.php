<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primary = 'id';
    protected $table = 'patients';
    protected $fillable = ['first_name', 'last_name', 'gender', 'status', 'id_number', 'image'];
    
    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function status_str(){
        return __('patient.status.' . $this->status);
    }

    public function reports(){
        return $this->hasMany('App\Models\Report');
    }
    public function departments(){
        return $this->hasMany('App\Models\Department');
    }
    public function users(){
        return $this->hasMany('App\User');
    }
}
