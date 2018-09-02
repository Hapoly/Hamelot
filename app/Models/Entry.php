<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $primary = 'id';
    protected $table = 'entries';
    protected $fillable = ['title', 'lon', 'lat', 'target_id', 'type', 'status', 'city_id', 'province_id', 'field_id', 'degree_id', 'public'];

    const HOSPITAL      = 1;
    const POLICLINIC    = 2;
    const CLINIC        = 3;
    const DOCTOR        = 4;
    const NURSE         = 5;

    private $type_lang = [
        1   => 'بیمارستان',
        2   => 'درمانگاه',
        3   => 'مطب',
        4   => 'دکتر',
        5   => 'پرستار',
    ];
    public function getTypeStrAttribute(){
        return $this->type_lang[$this->type];
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