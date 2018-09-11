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
    const NOT_SENT  = 5;
    public function getStatusStrAttribute(){
        return __('unit_users.status_str.' . $this->status);
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

    public function save(array $attributes = []){
        parent::save($attributes);
        foreach($this->unit->sub_units as $unit){
            $unit_user = UnitUser::where('unit_id', $unit->id)
                                 ->where('user_id', $this->user_id)
                                 ->first();
            if($unit_user){
                $unit_user->status = $this->status;
                $unit_user->save();
            }else
                $unit_user = UnitUser::create([
                    'unit_id'           => $unit->id,
                    'user_id'           => $this->user_id,
                    'permission'        => $this->permission,
                    'system_reserved'   => true,
                    'status'            => $this->status
                ]);
        }
    }
    public function delete(){
        foreach($this->unit->sub_units as $unit){
            UnitUser::where('user_id', $this->user_id)->where('unit_id', $this->unit_id)->delete();
        }
        parent::delete();
    }
}