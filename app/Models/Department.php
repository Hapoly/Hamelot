<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
        return $this->belongsToMany('App\User');
    }
    public function hasEditPermission(){
        if(Auth::user()->isAdmin())
            return true;
        if(Auth::user()->isManager()){
            return $this->hospital->whereHas('users', function($query){
                return $query->where('users.id', Auth::user()->id);
            })->first() != null;
        }
        if(Auth::user()->isPatient() || Auth::user()->isNurse() || Auth::user()->isDoctor())
            return false;
        return false;
    }
}
