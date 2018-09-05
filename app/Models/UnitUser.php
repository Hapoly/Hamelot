<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UnitUser extends Model
{
    protected $primary = 'id';
    protected $table = 'unit_user';
    protected $fillable = ['user_id', 'department_id', 'status', 'type', 'permission'];
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
    public function department(){
        return $this->belongsTo('App\Models\Department');
    }

    public static function fetch(){
        if(Auth::user()->isAdmin())
            return new UnitUser;
        else
            return UnitUser::whereHas('department', function($query){
                return $query->whereHas('hospital', function($query){
                    return $query->whereHas('users', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                });
            });
    }

    const POLICLINIC    = 1;
    const DEPARTMENT    = 2;
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
}
