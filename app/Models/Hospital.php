<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Hospital extends Model {
    protected $primary = 'id';
    protected $table = 'hospitals';
    protected $fillable = ['title', 'address', 'phone', 'mobile', 'image', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('hospitals.status_str.' . $this->status);
    }
    public function getAddressSummaryAttribute(){
        return substr($this->address, 0, 30) . '...';
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function hasPermission(){
        if(Auth::user()->group_code == 1)
            return true;
        else
            return $this->users()->where('user_id', Auth::user()->id)->first() != null;
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

    public static function get(){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return (new Hospital);
            case User::G_MANAGER:
                return Hospital::whereHas('users', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            case User::G_DOCTOR:
            case User::G_NURSE:
            case USER::G_PATIENT:
                return Hospital::whereHas('departments', function($query){
                    return $query->whereHas('users', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                });
        }
    }
}
