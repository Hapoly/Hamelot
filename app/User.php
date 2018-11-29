<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use DB;
use App\Models\Entry;
use App\Models\Permission;
use App\Models\Unit;
use App\Models\UnitUser;
use App\Models\Experiment;
use App\Models\Transaction;
use App\Models\ActivityTime;
use App\Models\Address;
use App\Models\OffTime;
use App\Models\Demand;
use App\Models\Bid;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Webpatser\Uuid\Uuid;
use App\Drivers\Time;

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
        'username', 'first_name', 'last_name', 'group_code', 'status', 'password', 'public', 'phone', 'email',
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
        if(Auth::user()->isAdmin() || $this->id == Auth::user()->id)
            return true;
        if(Auth::user()->isManager())
            return ($this->units()->whereHas('managers', function($query){
                return $query->where('users.id', Auth::user()->id);
            })->first()) != null;
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
    public function getSirMadamAttribute(){
        if($this->isAdmin() || $this->isManager())
            return ' - ';
        else{
            if($this->isPatient())
                return $this->patient->sir_madam_str;
            if($this->isDoctor())
                return $this->doctor->sir_madam_str;
            if($this->isNurse())
                return $this->nurse->sir_madam_str;
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
                break;
            case User::G_NURSE:
                $this->nurse->delete();
                break;
            case User::G_PATIENT:
                $this->patient->delete();
                break;
        }
        Entry::where('target_id', $this->id)->delete();
        UnitUser::where('user_id', $this->id)->delete();
        Permission::where('patient_id', $this->id)->delete();
        Permission::where('requester_id', $this->id)->delete();
        Experiment::where('user_id', $this->id)->delete();
        Address::where('user_id', $this->id)->delete();
        Demand::where('patient_id', $this->id)->delete();
        Bid::where('user_id', $this->id)->delete();
        OffTime::where('user_id', $this->id)->delete();
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

    public function outgoing_transactions(){
        return $this->hasMany('App\Models\Transaction', 'src_id');
    }
    public function incoming_transactions(){
        return $this->hasMany('App\Models\Transaction', 'dst_id');
    }
    public function all_credit(){
        $in = 0;
        $out = 0;
        if($this->isManager()){
            $out = Transaction::whereHas('src_unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', $this->id);
                });
            })  ->where('pay_type', Transaction::ONLINE_PAY)
                ->where('status', Transaction::PAID)->sum('amount');
            $in = Transaction::whereHas('dst_unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', $this->id);
                });
            })  ->where('pay_type', Transaction::ONLINE_PAY)
                ->where('status', Transaction::PAID)->sum('amount');
        }else if($this->isDoctor() || $this->isNurse()){
            $out = Transaction::whereHas('bid', function($query){
                return $query->where('user_id', Auth::user()->id);
            })  ->where('pay_type', Transaction::ONLINE_PAY)
                ->where('status', Transaction::PAID)
                ->whereIn('type', [Transaction::BID_DEPOSIT_BACK, Transaction::BID_REMAIN_BACK])->sum('amount');
            $in = Transaction::whereHas('bid', function($query){
                return $query->where('user_id', Auth::user()->id);
            })  ->where('pay_type', Transaction::ONLINE_PAY)
                ->where('status', Transaction::PAID)
                ->whereIn('type', [Transaction::BID_DEPOSIT_PAY, Transaction::BID_REMAIN_PAY])->sum('amount');
        }else if($this->isPatient()){
            $out = 0;
            $in = $this->incoming_transactions()  ->where('pay_type', Transaction::ONLINE_PAY)
                                                  ->where('status', Transaction::PAID)->sum('amount');
        }
        return intval($in - $out);
    }
    public function avialable_credit(){
        $in = 0;
        $out = 0;
        if($this->isManager()){
            $out = Transaction::whereHas('src_unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', $this->id);
                })->where('pay_type', Transaction::ONLINE_PAY);
            })->where('status', Transaction::PAID)->sum(DB::raw('(amount * (100-comission)) / 100'));
            $in = Transaction::whereHas('dst_unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', $this->id);
                });
            })->where('pay_type', Transaction::ONLINE_PAY)->where('status', Transaction::PAID)->sum(DB::raw('(amount * (100-comission)) / 100'));
        }else if($this->isDoctor() || $this->isNurse()){
            $out = Transaction::whereHas('bid', function($query){
                return $query->where('user_id', Auth::user()->id);
            })->where('pay_type', Transaction::ONLINE_PAY)->where('status', Transaction::PAID)
            ->whereIn('type', [Transaction::BID_DEPOSIT_BACK, Transaction::BID_REMAIN_BACK])->sum(DB::raw('(amount * (100-comission)) / 100'));
            $in = Transaction::whereHas('bid', function($query){
                return $query->where('user_id', Auth::user()->id);
            })->where('pay_type', Transaction::ONLINE_PAY)->where('status', Transaction::PAID)
            ->whereIn('type', [Transaction::BID_DEPOSIT_PAY, Transaction::BID_REMAIN_PAY])->sum(DB::raw('(amount * (100-comission)) / 100'));
        }else if($this->isPatient()){
            $out = 0;
            $in = $this->incoming_transactions()->where('status', Transaction::PAID)->sum(DB::raw('(amount * (100-comission)) / 100'));
        }
        return intval($in - $out);
    }
    public function activity_times($time = 0){
        $result = [];
        if($time == 0)
            $time = time();
        $day_of_week = intval(Time::jdate('w', $time, '', 'Asia/Tehran', 'en'))+1;
        for($i=1; $i<=7; $i++){
            $stamp = $time - (3600*24*($day_of_week-($i)));
            $result[$i] = [
                'date'  => Time::jdate('y/m/d', $stamp),
                'day'   => $stamp,
            ];
            if(OffTime::where('user_id', $this->id)
                      ->where('start_date', '<', $stamp)
                      ->where('finish_date', '>', $stamp)
                      ->first())
                $result[$i]['off'] = true;
            else
                $result[$i]['times'] = ActivityTime::whereHas('unit_user', function($query){
                    return $query->where('user_id', $this->id);
                })->where('day_of_week', $i)->get();
        }
        return $result;
    }


    /**
     * unit users status
     */
    public function getUnitUserAttribute(){
        return UnitUser::find($this->pivot->id);
    }

    public function getEmailStrAttribute(){
        if($this->email == 'NuLL')
            return '';
        else
            return $this->email;
    }
}
