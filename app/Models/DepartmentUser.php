<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    protected $primary = 'id';
    protected $table = 'department_users';
    protected $fillable = ['department_id', 'user_id'];

    public function department(){
        return $this->belongsToMany('App\Models\Department');
    }
    public function user(){
        return $this->belongsToMany('App\User');
    }
}