<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class DepartmentUser extends Model
{
    protected $primary = 'id';
    protected $table = 'department_user';
    protected $fillable = ['user_id', 'department_id', 'status'];
    protected $appends = ['status_str'];

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
            return new DepartmentUser;
        else
            return DepartmentUser::whereHas('department', function($query){
                return $query->whereHas('hospital', function($query){
                    return $query->whereHas('users', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                });
            });
    }
}
