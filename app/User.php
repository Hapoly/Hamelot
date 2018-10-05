<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use App\Models\Entry;
use App\Models\Permission;
use App\Models\Unit;
use App\Models\UnitUser;
use App\Models\Experiment;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Webpatser\Uuid\Uuid;
class User extends Authenticatable
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    use Notifiable, HasApiTokens;
    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;
    
    const G_ADMIN       = 1;
    const G_MANAGER     = 2;
    const G_DOCTOR      = 3;
    const G_NURSE       = 4;
    const G_PATIENT     = 5;
    
    const T_PUBLIC = 1;
    const T_PRIVATE = 2;
    
    public function getPublicStrAttribute(){
        return __('users.public_str.'.$this->public);
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
        return $this->belongsToMany('App\User', 'permissions', 'requester_id', 'patient_id')
                    ->wherePivot('status', Permission::ACCEPTED);
    }

    public static function getByName($name){
        return User::
            whereRaw("concat(first_name, ' ', last_name) = '$name'")
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
        if(!Auth::check())
            return false;
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
        if(!Auth::check())
            return false;
        return Auth::user()->isAdmin();
    }
    public function getPermissionToWriteHistoryAttribute(){
        if(!Auth::check())
            return false;
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
        if(!Auth::check())
            return false;
        return Auth::user()->isAdmin() || Auth::user()->isManager();
    }

    public static function fetch($joined=false){
        if(Auth::user()->isAdmin())
            return new User;
        else
            if($joined && Auth::user()->isManager()){
                return User::where([
                    ['group_code', '<>', User::G_ADMIN],
                    ['group_code', '<>', User::G_MANAGER],
                    ['group_code', '<>', User::G_PATIENT],
                    ['public', '=', User::T_PUBLIC],
                ])->whereHas('units', function($query){
                    return $query->whereHas('managers', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                });
            }else
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
            return Auth::user()->patients();
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
    public function getGenderAttribute(){
        if($this->isAdmin() || $this->isManager())
            return 0;
        else{
            if($this->isPatient())
                return $this->patient->gender;
            if($this->isDoctor())
                return $this->doctor->gender;
            if($this->isNurse())
                return $this->nurse->gender;
        }
    }
    public function getGenderStrAttribute(){
        if($this->isAdmin() || $this->isManager())
            return ' - ';
        else{
            if($this->isPatient())
                return $this->patient->gender_str;
            if($this->isDoctor())
                return $this->doctor->gender_str;
            if($this->isNurse())
                return $this->nurse->gender_str;
        }
    }
    public function getIdNumberAttribute(){
        if($this->isPatient())
            return $this->patient->id_number;
        else
            return null;
    }
    public function getIdNumberStrAttribute(){
        if($this->isPatient())
            return $this->patient->id_number_str;
        else
            return ' - ';
    }

    public function delete(){
        switch($this->group_code){
            case User::G_DOCTOR:
                $this->doctor->delete();
            case User::G_NURSE:
                $this->nurse->delete();
            case User::G_PATIENT:
                $this->patient->delete();
        }
        Entry::where('target_id', $this->id)->delete();
        UnitUser::where('user_id', $this->id)->delete();
        Permission::where('patient_id', $this->id)->delete();
        Permission::where('requester_id', $this->id)->delete();
        Experiment::where('user_id', $this->id)->delete();
        Address::where('user_id', $this->id)->delete();
        Demand::where('patient_id', $this->id)->delete();
        Bid::where('user_id', $this->id)->delete();
        parent::delete();
    }

    public function experiments(){
        return $this->hasMany('App\Models\Experiment', 'user_id');
    }

    public function getHasPermissionToRequestUnitAttribute(){
        return Auth::user()->isAdmin() || Auth::user()->isManager();
    }

    public function addresses(){
        return $this->hasMany('App\Models\Address', 'user_id');
    }

    public function save(array $options = []){
        if(!$this->id)
            $this->id = Uuid::generate()->string;
        parent::save($options);
    }

    public function all_credit(){
        return 120000;
    }
    public function avialable_credit(){
        return 115000;
    }
}
