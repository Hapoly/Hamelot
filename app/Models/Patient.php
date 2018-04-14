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
        return __('patients.status_str.' . $this->status);
    }

    const G_MALE        = 1;
    const G_FEMALE      = 2;

    public function gender_str(){
        return __('patients.gender_str.' . $this->gender);
    }
    public function reports(){
        return $this->hasMany('App\Models\Report');
    }
    public function departments(){
        return $this->hasMany('App\Models\DepartmentPatient');
    }
    public function users(){
        return $this->hasMany('App\Models\PatientUser');
    }
}
