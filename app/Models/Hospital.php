<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\Models\Entry;
use App\Models\UnitUser;

class Hospital extends Model {
    
    public function requests(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_id')
                    ->wherePivot('type', UnitUser::HOSPITAL);
    }
    public function users(){
        return $this->belongsToMany('App\User', 'unit_user', 'unit_parent_id')
                    ->wherePivot('type', UnitUser::DEPARTMENT)
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


}
