<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Models\Entry;
use App\Models\Permission;
use App\Models\Unit;
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
        'username', 'first_name', 'last_name', 'group_code', 'status', 'password', 'public',
    ];
    protected $appends = [
        'permission_to_read_info',  'permission_to_read_history',   'permission_to_read_units',
        'permission_to_write_info', 'permission_to_write_history',  'permission_to_write_units',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function units(){
        return $this->belongsToMany('App\Models\Unit', 'unit_user', 'user_id', 'unit_id')
                    ->wherePivot('status', UnitUser::ACCEPTED);
    }

    public function visitors(){
        return $this->belongsToMany('App\User', 'permissions', 'patient_id', 'requester_id')
                    ->wherePivot('status', Permission::ACCEPTED);
    }
    public function patients(){
        if($this->isDoctor() || $this->isNurse()){
            return User::whereHas('requests', function($query){
                return $query->where('status', Permission::ACCEPTED)
                            ->where('requester_id', $this->id);
            });
        }else{
            return null;
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
    public function getPermissionToReadInfoAttribute(){
        return true;
    }
    public function getPermissionToReadHistoryAttribute(){
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
    public function getPermissionToReadUnitsAttribute(){
        return true;
    }
    public function getPermissionToWriteInfoAttribute(){
        return Auth::user()->isAdmin();
    }
    public function getPermissionToWriteHistoryAttribute(){
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
    public function getPermissionToWriteUnitsAttribute(){
        return Auth::user()->isAdmin() || Auth::user()->isManager();
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
        return ' - ';
    }
    public function getDegreeStrAttribute(){
        if($this->isDoctor())
            return $this->doctor->degree_str;
        else if($this->isNurse())
            return $this->nurse->degree_str;
        return ' - ';
    }
    public function getMscStrAttribute(){
        if($this->isDoctor())
            return $this->doctor->msc_str;
        else if($this->isNurse())
            return $this->nurse->msc_str;
        return ' - ';
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
    /**
     * patients attributes
     */
    public function getIdNumberAttribute(){
        if($this->isPatient())
            return $this->patient->id_number;
        else
            return ' - ';
    }
    public function getAgeAttribute(){
        if($this->isPatient())
            return $this->patient->age;
        else
            return ' - ';
    }
    public function getAgeStrAttribute(){
        if($this->isPatient())
            return $this->patient->age_str;
        else
            return ' - ';
    }

    public function delete(){
        switch($this->group_code){
            case User::G_DOCTOR:
                $this->doctor->delete();
            case User::G_NURSE:
                $this->nurse->delete();
        }
        Entry::where('target_id', $this->id)->delete();
        UnitUser::where('user_id', $this->id)->delete();
        parent::delete();
    }

    public function experiments(){
        return $this->hasMany('App\Models\Experiment', 'user_id');
    }

    public function getHasPermissionToRequestUnitAttribute(){
        return Auth::user()->isAdmin() || Auth::user()->isManager();
    }
}
