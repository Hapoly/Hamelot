<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Clinic extends Model
{
    protected $primary = 'id';
    protected $table = 'clinics';
    protected $fillable = ['address', 'description', 'type', 'status', 'phone', 'public', 'mobile', 'doctor_id', 'city_id', 'lon', 'lat'];
    
    const ACTIVE    = 1;
    const INACTIVE  = 2;
    private $status_lang = [
        1   => 'فعال',
        2   => 'غیرفعال',
    ];
    public function getStatusStrAttribute(){
        return $this->status_lang[$this->status];
    }


    const T_PUBLIC  = 1;
    const T_PRIVATE = 2;
    private $public_lang = [
        1   => 'عمومی',
        2   => 'خصوصی',
    ];
    public function getPublicStrAttribute(){
        return $this->public_lang[$this->public];
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
        return $this->belongsTo('App\User');
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public static function fetch($joined){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return (new Clinic);
            case User::G_MANAGER:
                return Clinic::where('public', Clinic::T_PUBLIC)->where('status', Clinic::ACTIVE);
            case User::G_DOCTOR:
                if($joined)
                    return Clinic::where('doctor_id', Auth::user()->id);
                else
                    return Clinic::where('public', Clinic::T_PUBLIC)->where('status', Clinic::ACTIVE);
            case User::G_NURSE:
            case USER::G_PATIENT:
                return Clinic::where('public', Clinic::T_PUBLIC)->where('status', Clinic::ACTIVE);
        }
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

    public function getHasPermissionAttribute(){
        if(Auth::user()->isAdmin())
            return true;
        else
            return Auth::user()->id == $this->doctor_id;
    }
}
