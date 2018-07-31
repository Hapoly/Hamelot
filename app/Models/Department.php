<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primary = 'id';
    protected $table = 'departments';
    protected $fillable = ['title', 'description', 'hospital_id', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('departments.status_str.' . $this->status);
    }
    public function patients(){
        return $this->hasMany('App\Models\DepartmentPatient');
    }
    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }
    public function users(){
        return $this->hasMany('App\User');
    }
    public function hasEditPermission(){
        
    }
}
