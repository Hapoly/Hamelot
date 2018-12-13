<?php

namespace App\Models;

use App\UModel;


class Entry extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'entries';
    protected $fillable = [
        'title',
        'lon', 'lat', 'city_id', 'province_id',
        'target_id', 
        'type', 'status', 'public', 'group_code'];

    const HOSPITAL      = 1;
    const DEPARTMENT    = 2;
    const POLICLINIC    = 3;
    const LABRATORY     = 4;
    const CLINIC        = 5;
    const DOCTOR        = 6;
    const NURSE         = 7;
    
    public function getGroupCodeStrAttribute(){
        return __('entries.group_code_str.' . $this->group_code);
    }


    const ACTUAL    = 1;
    const VIRTUAL   = 2;
    public function getTypeStrAttribute(){
        return __('entries.type_str.' . $this->type);
    }

    const ACTIVE    = 1;
    const INACTIVE  = 2;
    public function getStatusStrAttribute(){
        return __('entries.status_str.' . $this->status);
    }

    const T_PUBLIC  = 1;
    const T_PRIVATE = 2;

    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'target_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'target_id');
    }

    public function city(){
        return $this->hasOne('App\Models\City');
    }
    public function province(){
        return $this->hasOne('App\Models\Province');
    }
}