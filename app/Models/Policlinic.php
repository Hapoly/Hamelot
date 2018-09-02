<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policlinic extends Model
{
    protected $primary = 'id';
    protected $table = 'policlinics';
    protected $fillable = ['title', 'address', 'description', 'type', 'status', 'phone', 'lon', 'lat', 'city_id'];

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

    public function city(){
        return $this->belongsTo('App\Models\City');
    }
}
