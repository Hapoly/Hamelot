<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $primary = 'id';
    protected $table = 'clinics';
    protected $fillable = ['address', 'description', 'type', 'status', 'phone', 'doctor_id', 'city_id', 'lon', 'lat'];
    
    const ACTIVE    = 1;
    const INACTIVE  = 2;
    private $status_lang = [
        1   => 'فعال',
        2   => 'غیرفعال',
    ];
    public function getStatusStrAttribute(){
        return $this->status_lang[$this->status];
    }

    const ACTUAL    = 1;
    const VIRTUAL   = 2;
    private $type_lang = [
        1   => 'واقعی',
        2   => 'مجازی',
    ];
    public function getTypeStrAttribute(){
        return $this->type_lang[$this->type];
    }

    public function doctor(){
        return $this->hasOne('App\User');
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }
}
