<?php

namespace App\Models;

use App\UModel;

use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Experiment;
use App\Models\UnitUser;
use App\Models\Entry;
use Webpatser\Uuid\Uuid;

use App\Drivers\Time;

class Unit extends UModel{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'units';
    protected $fillable = ['title', 'address', 'phone', 'mobile', 'image', 'lon', 'lat', 'city_id', 'group_code', 'type', 'public', 'status', 'parent_id', 'slug'];
    protected $appends = ['complete_title'];

    public static function getByTitle($title){
        return Unit::where('title', $title)->first();
    }
    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;
    public function getStatusStrAttribute(){
        return __('units.status_str.' . $this->status);
    }

    const T_PUBLIC  = 1;
    const T_PRIVATE = 2;
    public function getPublicStrAttribute(){
        return __('units.public_str.' . $this->public);
    }

    const ACTUAL    = 1;
    const VIRTUAL   = 2;
    public function getTypeStrAttribute(){
        return __('units.type_str.' . $this->type);
    }

    public function getCompleteTitleAttribute(){
        if($this->parent_id == '0')
            return $this->title;
        else
            return $this->title . ' - '. $this->parent->title;
    }
    public function getAddressSummaryAttribute(){
        return substr($this->address, 0, 30) . '...';
    }

    public function reports(){
        return $this->hasMany('App\Models\Reports');
    }

    public function parent(){
        return $this->belongsTo('App\Models\Unit', 'parent_id');
    }
    public function sub_units(){
        return $this->hasMany('App\Models\Unit', 'parent_id');
    }

    public function requests(){
        return $this->hasMany('App\Models\UnitUser');
    }

    public function members(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('permission', UnitUser::MEMBER)
                    ->wherePivot('status', UnitUser::ACCEPTED)
                    ->using((new class extends \Illuminate\Database\Eloquent\Relations\Pivot {
                        protected $casts = ['id' => 'string'];
                    }))->withPivot('id');
    }

    public function managers(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('permission', UnitUser::MANAGER)
                    ->wherePivot('status', UnitUser::ACCEPTED)
                    ->using((new class extends \Illuminate\Database\Eloquent\Relations\Pivot {
                        protected $casts = ['id' => 'string'];
                    }))->withPivot('id');
    }

    public function secretaries(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('permission', UnitUser::SECRETARY)
                    ->wherePivot('status', UnitUser::ACCEPTED)
                    ->using((new class extends \Illuminate\Database\Eloquent\Relations\Pivot {
                        protected $casts = ['id' => 'string'];
                    }))->withPivot('id');
    }

    public function getImageUrlAttribute(){
        if($this->image == 'NuLL')
            return url('/defaults/hospital.png');
        else
            return url($this->image);
    }


    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    private $group_code_to_gc = [
        Unit::HOSPITAL      => Entry::HOSPITAL,
        Unit::DEPARTMENT    => Entry::DEPARTMENT,
        Unit::POLICLINIC    => Entry::POLICLINIC,
        Unit::CLINIC        => Entry::CLINIC,
        Unit::LABRATORY     => Entry::LABRATORY,
    ];
    public function save(array $options = []){
        if(!$this->id)
            $this->id = Uuid::generate()->string;
        parent::save($options);
        
        // check if dont have secretary, creates it
        $secretary = User::where('phone', $this->mobile)->first();
        if(!$secretary){
            $secretary = User::create([
                'phone'         => $this->mobile,
                'group_code'    => User::G_SECRETARY,
            ]);
        }
        if($secretary->isSecretary()){
            UnitUser::create([
                'unit_id'       => $this->id,
                'user_id'       => $this->id,
                'permission'    => UnitUser::SECRETARY,
                'status'        => UnitUser::ACCEPTED,
            ]);
        }


        $entry = Entry::where('target_id', $this->id)->where('group_code', $this->group_code_to_gc[$this->group_code])->first();
        $data = [
            'target_id'     => $this->id,
            'title'         => $this->title,
            'lon'           => $this->lon,
            'lat'           => $this->lat,
            'city_id'       => $this->city_id,
            'province_id'   => $this->city->province_id,
            
            'group_code'    => $this->group_code,
            'public'        => $this->public,
            'type'          => $this->type,
        ];
        if($this->status)
            $data['status'] = $this->status;

        if($entry){
            $entry->fill($data);
            $entry->save();  
        }else{
            Entry::create($data);
        }   
    }

    public function delete(){
        Storage::disk('public')->delete($this->image);
        Entry::where('target_id', $this->id)->where('group_code', $this->group_code_to_gc[$this->group_code])->delete();
        UnitUser::where('unit_id', $this->id)->delete();
        Experiment::where('unit_id', $this->id)->delete();
        BankAccount::where('unit_id', $this->id)->delete();
        Transaction::where('src_id', $this->id)->orWhere('dst_id', $this->id)->delete();
        foreach($this->sub_units as $sub_unit){
            $sub_unit->delete();
        }
        parent::delete();
    }

    public function getPhoneStrAttribute(){
        if($this->phone == 'NuLL')
            return '-';
        else
            return $this->phone;
    }
    public function getMobileStrAttribute(){
        if($this->mobile == 'NuLL')
            return '-';
        else
            return $this->mobile;
    }

    const HOSPITAL      = 1;
    const DEPARTMENT    = 2;
    const POLICLINIC    = 3;
    const CLINIC        = 4;
    const LABRATORY     = 5;
    public function getGroupStrAttribute(){
        return __('units.group_code_str.' . $this->group_code);
    }

    public static function fetch($joined){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return (new Unit);
            case User::G_MANAGER:
            case User::G_DOCTOR:
            case User::G_NURSE:
            case User::G_SECRETARY:
                if($joined)
                    return Unit::whereHas('requests', function($query){
                        return $query->where('user_id', Auth::user()->id);
                    });
                else
                    return (new Unit);
            case User::G_PATIENT:
                return Unit::where('public', Unit::T_PUBLIC);
        }
    }


    public function getHasPermissionAttribute(){
        if(Auth::user()->isAdmin())
            return true;
        else if(Auth::user()->isManager())
            return $this->managers()->where('users.id', Auth::user()->id)->first() != null;
        else
            return false;
    }
    public function getJoinedAttribute(){
        if(Auth::user()->isManager())
            return $this->requests()->where('user_id', Auth::user()->id)->first() != null;
        else if(Auth::user()->isAdmin() || Auth::user()->isPatient())
            return false;
        else
            return $this->requests()->where('user_id', Auth::user()->id)->first() != null;
    }
    public function getCanJoinAttribute(){
        if(Auth::user()->isManager())
            return $this->requests()->where('user_id', Auth::user()->id)->first() == null;
        else if(Auth::user()->isAdmin() || Auth::user()->isPatient())
            return false;
        else
            return $this->requests()->where('user_id', Auth::user()->id)->first() == null;
    }
    public function getJoinedStatusAttribute(){
        return $this->requests()->where('user_id', Auth::user()->id)->first()->status;
    }
    public function getJoinedStatusStrAttribute(){
        $request = $this->requests()->where('user_id', Auth::user()->id)->first();
        if($request)
            return $request->status_str;
        else
            return __('unit_users.status_str.5');
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
            $result[$i]['times'] = ActivityTime::whereHas('unit_user', function($query){
                return $query->where('unit_id', $this->id);
            })->where('day_of_week', $i)->get();
        }
        return $result;
    }
}
