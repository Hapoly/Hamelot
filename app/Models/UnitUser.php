<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UnitUser extends Model
{
    protected $primary = 'id';
    protected $table = 'unit_user';
    protected $fillable = ['user_id', 'unit_id', 'status', 'permission'];
    protected $appends = ['status_str', 'type_str'];

    const PENDING   = 1;
    const ACCEPTED  = 2;
    const REFUSED   = 3;
    const CANCELED  = 4;
    private $status_lang = [
        1   => 'در انتظار',
        2   => 'تایید شده',
        3   => 'رد شده',
        4   => 'منقضی شده',
    ];
    public function getStatusStrAttribute(){
        return $this->status_lang[$this->status];
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public static function fetch($type, $permission){
        if(Auth::user()->isAdmin())
            return new UnitUser;
        else if(Auth::user()->isManager()){
            return UnitUser::whereHas('unit_parent', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            });
        }
    }
    
    const MEMBER = 1;
    const MANAGER = 2;
    private $permission_lang = [
        1   => 'عضو',
        2   => 'مدیریت',
    ];
    public function getPermissionStrAttribute(){
        return $this->permisison_lang[$this->permission];
    }


    public function pending(){
        return $this->status == Permission::PENDING;
    }
    public function accepted(){
        return $this->status == Permission::ACCEPTED;
    }
    public function refused(){
        return $this->status == Permission::REFUSED;
    }
    public function canceled(){
        return $this->status == Permission::CANCELED;
    }

    public function getHasManagerPermissionAttribute(){
        if(Auth::user()->isAdmin())
            return true;
        else if(Auth::user()->isManager()){
            return $this->unit_parent->managers()->where('users.id', Auth::user()->id)->first() != null;
        }else
            return false;
    }

    public function canAccept(){
        if($this->status != UnitUser::PENDING)
            return false;
        $user = Auth::user();
        if($user->isAdmin())
            return true;
        else if($user->isManager())
            return $this->unit->managers()->where('users.id', $user->id)->first() != null;
        else
            return false;
    }
    public function canRefuse(){
        if($this->status != UnitUser::PENDING)
            return false;
        $user = Auth::user();
        if($user->isAdmin())
            return true;
        else if($user->isManager())
            return $this->unit->managers()->where('users.id', $user->id)->first() != null;
        else
            return false;
    }
    public function canCancel(){
        if($this->status != UnitUser::ACCEPTED)
            return false;
        $user = Auth::user();
        if($user->isAdmin())
            return true;
        else if($user->isManager())
            return $this->unit->managers()->where('users.id', $user->id)->first() != null;
        else
            return false;
    }
}
