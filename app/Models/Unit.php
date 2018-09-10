<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Unit;
use App\Models\Entry;
use App\User;
use Auth;

class Unit extends Model
{
    protected $primary = 'id';
    protected $table = 'units';
    protected $fillable = ['title', 'address', 'phone', 'mobile', 'image', 'lon', 'lat', 'city_id', 'group_code', 'type', 'public', 'status'];


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

    public function getAddressSummaryAttribute(){
        return substr($this->address, 0, 30) . '...';
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


    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function save(array $options = []){
        parent::save($options);
        $entry = Entry::where('target_id', $this->id)->where('type', $this->group_code)->first();
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
            $entry['status'] = $this->status;

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


    const DEPARTMENT    = 1;
    const POLICLINIC    = 2;
    const HOSPITAL      = 3;
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
}
