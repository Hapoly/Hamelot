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

class Unit extends UModel{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'units';
    protected $fillable = ['title', 'address', 'phone', 'mobile', 'image', 'lon', 'lat', 'city_id', 'group_code', 'type', 'public', 'status', 'parent_id'];
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
        if($this->parent_id == 0)
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
                    ->withPivot('id');
    }

    public function managers(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('permission', UnitUser::MANAGER)
                    ->wherePivot('status', UnitUser::ACCEPTED)
                    ->withPivot('id');
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
                if($joined)
                    return Unit::whereHas('requests', function($query){
                        return $query->where('user_id', Auth::user()->id);
                    });
                else
                    return (new Unit);
            case USER::G_PATIENT:
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
}
