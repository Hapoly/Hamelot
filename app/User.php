<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Models\Permission;
use App\Models\Department;
use App\Models\UnitUser;
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
    protected $appends = [
        'permission_to_info', 'permission_to_history', 'permission_to_departments',
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
        return $this->belongsToMany('App\Models\Hospital', 'unit_user', 'user_id', 'unit_id')
                    ->wherePivot('type', UnitUser::HOSPITAL)
                    ->wherePivot('permission', UnitUser::MANAGER)
                    ->wherePivot('status', UnitUser::ACCEPTED);
    }

    public function policlinics(){
        return $this->belongsToMany('App\Models\Policlinic', 'unit_user', 'user_id', 'unit_id')
                    ->wherePivot('type', UnitUser::POLICLINIC)
                    ->wherePivot('permission', UnitUser::MANAGER)
                    ->wherePivot('status', UnitUser::ACCEPTED);
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
        return $this->belongsToMany('App\Models\Department', 'unit_user', 'user_id', 'unit_id')
                    ->wherePivot('type', UnitUser::DEPARTMENT)
                    ->wherePivot('permission', UnitUser::MEMBER)
                    ->wherePivot('status', UnitUser::ACCEPTED);;
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
                    return $this->public == User::T_PUBLIC;
                else if($this->isAdmin())
                    return false;
                else if($this->isDoctor() || $this->isNurse())
                    return $this->public == User::T_PUBLIC;
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
                else if($this->isAdmin() || $this->isManager())
                    return false;
                else
                    return $this->public == User::T_PUBLIC;
            default:
                return false;
        }
        return false;
    }
    public function getPermissionToHistoryAttribute(){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
                return false;
            case User::G_DOCTOR:
            case User::G_NURSE:
                return User::whereHas('permissions', function($query){
                    return $query->where([
                            ['requester_id' => Auth::user()->id],
                            ['status'       => Permission::ACCEPTED]]);
                })->first() != null;
            case User::G_PATIENT:
                return $this->id == Auth::user()->id;
        }
        return false;
    }

    public function getPermissionToDepartmentsAttribute(){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
                return User::whereHas('departments', function($query){
                    return $query->whereHas('hospital', function($query){
                        return $query->whereHas('users', function($query){
                            return $query->where('users.id', Auth::user()->id);
                        });
                    });
                })->first() != null;
            case User::G_DOCTOR:
            case User::G_NURSE:
                return $this->id == Auth::user()->id;
            case User::G_PATIENT:
                return false;
        }
        return false;
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
        return $this->hasMany('App\Models\UnitUser', 'user_id');
    }

    /**
     * doctors and nurses attributes
     */
    public function getFieldStrAttribute(){
        if($this->isDoctor())
            return $this->doctor->field_str;
        else if($this->isNurse())
            return $this->nurse->field_str;
        return null;
    }
    public function getDegreeStrAttribute(){
        if($this->isDoctor())
            return $this->doctor->degree_str;
        else if($this->isNurse())
            return $this->nurse->degree_str;
        return null;
    }
    public function getMscStrAttribute(){
        if($this->isDoctor())
            return $this->doctor->msc_str;
        else if($this->isNurse())
            return $this->nurse->msc_str;
        return null;
    }
    public function getFieldAttribute(){
        if($this->isDoctor())
            return $this->doctor->field;
        else if($this->isNurse())
            return $this->nurse->field;
        return null;
    }
    public function getDegreeAttribute(){
        if($this->isDoctor())
            return $this->doctor->degree;
        else if($this->isNurse())
            return $this->nurse->degree;
        return null;
    }
    public function getMscAttribute(){
        if($this->isDoctor())
            return $this->doctor->msc;
        else if($this->isNurse())
            return $this->nurse->msc;
        return null;
    }

}
