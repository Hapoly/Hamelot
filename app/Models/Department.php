<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use User;

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
    public static function get(){
        if(Auth::user()->isAdmin())
            return (new Department);
        else if(Auth::user()->isManager())
            return Department::whereHas('hospital', function($query){
                return $query->whereHas('users', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            });
        else
            return Department::whereHas('users', function($query){
                return $query->where('users.id', Auth::user()->id);
            });
    }
    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function patients(){
        return $this->users()->where('group_code', User::G_PATIENT);
    }
    public function doctors(){
        return $this->users()->where('group_code', User::G_DOCTOR);
    }
    public function nurses(){
        return $this->users()->where('group_code', User::G_NURSE);
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
