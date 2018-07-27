<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function status_str(){
        return __('users.status_str.' . $this->status);
    }
    
    const G_ADMIN       = 1;
    const G_MANAGER     = 2;
    const G_DOCTOR      = 3;
    const G_NURSE       = 4;
    const G_PATIENT     = 5;

    public function group_code_str(){
        return __('users.group_code_str.' . $this->group_code);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'group_code', 'status', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hospitals(){
        return $this->hasMany('App\Models\HospitalUser');
    }
    public function departments(){
        return $this->hasMany('App\Models\DepartmentUser');
    }
    public function patients(){
        return $this->hasMany('App\Models\PatientUser');
    }
}
