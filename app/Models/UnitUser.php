<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UnitUser extends Model
{
    protected $primary = 'id';
    protected $table = 'unit_user';
    protected $fillable = ['user_id', 'unit_id', 'unit_parent_id', 'status', 'type', 'permission'];
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
        switch($this->type){
            case UnitUser::HOSPITAL:
                return $this->belongsTo('App\Models\Hospital', 'unit_id');
            case UnitUser::DEPARTMENT:
                return $this->belongsTo('App\Models\Department', 'unit_id');
            case UnitUser::POLICLINIC:
                return $this->belongsTo('App\Models\Policlinic', 'unit_id');
        }
    }
    public function unit_parent(){
        switch($this->type){
            case UnitUser::HOSPITAL:
            case UnitUser::DEPARTMENT:
                return $this->belongsTo('App\Models\HOSPITAL', 'unit_id');
            case UnitUser::POLICLINIC:
                return $this->belongsTo('App\Models\Policlinic', 'unit_id');
        }
    }
    public function unitParent(){
        return $this->belongsTo('App\Models\Hospital', 'unit_id');
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

    const DEPARTMENT    = 1;
    const POLICLINIC    = 2;
    const HOSPITAL      = 3;
    private $type_lang = [
        1   => 'بخش',
        2   => 'درمانگاه',
        3   => 'بیمارستان'
    ];
    public function getTypeStrAttribute(){
        return $this->type_lang[$this->type];
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
}
