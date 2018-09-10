<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $primary = 'id';
    protected $table = 'entries';
    protected $fillable = [
        'title',
        'lon', 'lat', 'city_id', 'province_id',
        'target_id', 
        'field_id', 'degree_id',
        'type', 'status', 'public', 'group_code'];

    const HOSPITAL      = 1;
    const DEPARTMENT    = 2;
    const POLICLINIC    = 3;
    const CLINIC        = 4;
    const DOCTOR        = 4;
    const NURSE         = 5;
    public function getGroupCodeStrAttribute(){
        return __('units.group_code_str.' . $this->group_code);
    }


    const ACTUAL    = 1;
    const VIRTUAL   = 2;
    public function getTypeStrAttribute(){
        return __('units.type_str.' . $this->type);
    }

    const ACTIVE    = 1;
    const INACTIVE  = 2;
    private $status_lang = [
        1   => 'فعال',
        2   => 'غیرفعال',
    ];
    public function getStatusStrAttribute(){
        return $this->status_lang[$this->status];
    }

    public function target(){
        switch($this->type){
            case Entry::HOSPITAL:
                return $this->hasOne('App\Models\Hospital', 'target_id');
            case Entry::POLICLINIC:
                return $this->hasOne('App\Models\Policlinic', 'target_id');
            case Entry::CLINIC:
                return $this->hasOne('App\Models\Clinic', 'target_id');
            case Entry::DOCTOR:
                return $this->hasOne('App\User', 'target_id');
            case Entry::NURSE:
                return $this->hasOne('App\User', 'target_id');
            default:
                return null;
        }
    }

    public function degree(){
        return $this->hasOne('App\Models\ConstValue');
    }
    public function field(){
        return $this->hasOne('App\Models\ConstValue');
    }

    public function city(){
        return $this->hasOne('App\Models\City');
    }
    public function province(){
        return $this->hasOne('App\Models\Province');
    }
}