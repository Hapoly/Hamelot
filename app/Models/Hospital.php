<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\Models\Entry;
use App\Models\UnitUser;

class Hospital extends Model {
    protected $primary = 'id';
    protected $table = 'hospitals';
    protected $fillable = ['title', 'address', 'phone', 'mobile', 'image', 'status', 'lon', 'lat', 'city_id'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('hospitals.status_str.' . $this->status);
    }
    public function getAddressSummaryAttribute(){
        return substr($this->address, 0, 30) . '...';
    }
    public function users(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('type', UnitUser::HOSPITAL)
                    ->wherePivot('permission', UnitUser::MEMBER)
                    ->wherePivot('status', UnitUser::ACCEPTED);
    }

    public function managers(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('type', UnitUser::HOSPITAL)
                    ->wherePivot('permission', UnitUser::MANAGER)
                    ->wherePivot('status', UnitUser::ACCEPTED);
    }

    public function getHasPermissionAttribute(){
        if(Auth::user()->isAdmin())
            return true;
        else if(Auth::user()->isManager())
            return $this->users()->where('users.id', Auth::user()->id)->first() != null;
        else
            return false;
    }
    public function departments(){
        return $this->hasMany('App\Models\Department');
    }
    public function reports(){
        return $this->hasMany('App\Models\Reports');
    }
    public function getImageUrlAttribute(){
        if($this->image == 'NuLL')
            return url('/defaults/hospital.png');
        else
            return url($this->image);
    }

    public function getJoinedAttribute(){
        if(Auth::user()->isManager())
            return $this->users()->where('users.id', Auth::user()->id)->first() != null;
        else if(Auth::user()->isAdmin() || Auth::user()->isPatient())
            return false;
        else
            return $this->departments()->whereHas('users', function($query){
                return $query->where(['users.id'=> Auth::user()->id]);
            })->first() != null;
    }

    public static function fetch($joined){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return (new Hospital);
            case User::G_MANAGER:
                if($joined)
                    return Hospital::whereHas('users', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                else
                    return new Hospital;
            case User::G_DOCTOR:
            case User::G_NURSE:
            case USER::G_PATIENT:
                if($joined)
                    return Hospital::whereHas('departments', function($query){
                        return $query->whereHas('requests', function($query){
                            return $query->where('unit_user.user_id', Auth::user()->id)->where('status', UnitUser::ACCEPTED);
                        });
                    });
                else
                    return new Hospital;
        }
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function save(array $options = []){
        parent::save($options);
        $entry = Entry::where('target_id', $this->id)->where('type', Entry::HOSPITAL)->first();
        $data = [
            'target_id'     => $this->id,
            'title'         => $this->title,
            'lon'           => $this->lon,
            'lat'           => $this->lat,
            'city_id'       => $this->city_id,
            'province_id'   => $this->city->province_id,
            'status'        => $this->status,
            'type'          => Entry::HOSPITAL,
        ];
        if($entry){
            $entry->fill($data);
            $entry->save();  
        }else{
            Entry::create($data);
        }   
    }

    public function delete(){
        parent::delete();
        Entry::where('target_id', $this->id)->where('type', Entry::HOSPITAL)->delete();
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
}
