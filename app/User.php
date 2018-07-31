<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Models\Permission;
use App\Models\Department;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;
    
    const G_ADMIN       = 1;
    const G_MANAGER     = 2;
    const G_DOCTOR      = 3;
    const G_NURSE       = 4;
    const G_PATIENT     = 5;

    public function isAdmin(){
        return $this->group_code == User::G_ADMIN;
    }
    public function isManager(){
        return $this->group_code == User::G_MANAGER;
    }
    public function isDoctor(){
        return $this->group_code == User::G_DOCTOR;
    }
    public function isNurse(){
        return $this->group_code == User::G_NURSE;
    }
    public function isPatient(){
        return $this->group_code == User::G_PATIENT;
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
        return $this->belongsToMany('App\Models\Hospital');
    }

    public function hospitalDepartments(){
        if(Auth::user()->isAdmin())
            return Department::all();
        $id = $this->id;
        return Department::whereHas('hospital', function($query) use ($id){
            return $query->whereHas('users', function($query) use ($id){
                return $query->where('users.id', $id);
            });
        })->get();
    }

    public function departments(){
        return $this->belongsToMany('App\Models\Department');
    }

    public function getGroupStrAttribute(){
        return __('users.group_code_str.' . $this->group_code);
    }
    public function getStatusStrAttribute(){
        return __('users.status_str.' . $this->status);
    }
    /**
     * get more info functions
     */
    public function nurse(){
        return $this->hasOne('App\Models\Nurse');
    }
    public function doctor(){
        return $this->hasOne('App\Models\Doctor');
    }
    public function patient(){
        return $this->hasOne('App\Models\Patient');
    }
    /**
     * method: has permission to
     * description: defines if user has permission to an object
     */
    public function hasPermissionToUser(User $user){
        switch($this->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
                if($user->isAdmin() || $user->isManager())
                    return false;
                else if($user->group_code == User::G_DOCTOR)
                    return $user->departments()->whereHas('hospital', function($query){
                        return $query->whereHas('users', function($query){
                            return $query->where('users.id', Auth::user()->id);
                        });
                    })->first() != null;
                else
                    return true;
            default:
                return false;
        }
        return false;
    }
}
