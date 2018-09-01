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
    
    const T_PUBLIC = 1;
    const T_PRIVATE = 2;
    
    protected $public_lang = [
        1   => 'عمومی',
        2   => 'خصوصی',
    ];
    public function getPublicStrAttribute(){
        return $this->public_lang[$this->public];
    }

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

    public function patients(){
        switch($this->group_code){
            case User::G_ADMIN:
                return User::where('group_code', User::G_PATIENT)->get();
            case User::G_MANAGER:
                User::whereHas('hospital', function($query){
                    return $query->whereHas('users', function($query){
                        return $query->where('users.id', $this->id)->where('users.group_code', User::G_PATIENT);
                    });
                })->get();
            case User::G_DOCTOR:
            case User::G_NURSE:
                return User::whereHas('departments', function($query){
                    return $query->whereHas('hospital', function($query){
                        return $query->whereHas('users', function($query){
                            return $query->where('users.id', $this->id)->where('users.group_code', User::G_PATIENT);
                        });
                    });
                })->get();
            default:
                return [];
        }
    }

    public static function getByName($name){
        return User::
            whereRaw("concat(first_name, ' ', last_name) LIKE '%$name%'")
                ->where('group_code', User::G_PATIENT)
                ->first();
    }

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
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
    public function getPermissionToInfoAttribute(){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
                if($this->isManager())
                    return true;
                else if($this->isAdmin())
                    return false;
                else if($this->isDoctor() || $this->isNurse())
                    return true;
                else
                    return User::whereHas('permissions', function($query){
                        return $query->whereHas('requester', function($query){
                            return $query->whereHas('departments', function($query){
                                return $query->whereHas('hospital', function($query){
                                    return $query->whereHas('users', function($query){
                                        return $query->where('users.id', Auth::user()->id);
                                    });
                                });
                            });
                        });
                    })->first() != null;
            case User::G_DOCTOR:
            case User::G_NURSE:
            case User::G_PATIENT:
                if($this->isPatient())
                    return $this->permissions()->where('user_id', $this->id)->where('status', User::ACCEPTED)->first() != null;
                else
                    return true;
            default:
                return false;
        }
        return false;
    }
    public function getPermissionToHistoryAttribute(User $user){
        switch($this->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
                return false;
        }
    }

    public static function fetch(){
        if(Auth::user()->isAdmin())
            return new User;
        else
            return User::where([
                ['group_code', '<>', User::G_ADMIN],
                ['group_code', '<>', User::G_MANAGER],
                ['group_code', '<>', User::G_PATIENT],
                ['public', '=', User::T_PUBLIC],
            ]);
    }

    public static function fetchPatients(){
        if(Auth::user()->isAdmin())
            return new User;
        else
            return User::whereHas('requests', function($query){
                return $query->where('requester_id', Auth::user()->id);
            });
    }


    public function permissions(){
        return $this->hasMany('App\Models\Permission', 'requester_id');
    }
    public function requests(){
        return $this->hasMany('App\Models\Permission', 'patient_id');
    }
    public function departmenReuqests(){
        return $this->hasMany('App\Models\DepartmentUser', 'user_id');
    }
}
