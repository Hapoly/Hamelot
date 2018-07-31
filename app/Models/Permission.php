<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Permission extends Model
{
    protected $primary = 'id';
    protected $table = 'permissions';
    protected $fillable = ['group_code', 'label'];

    public static function has($label){
        return  Permission::where([
            'label'         => $label,
            'group_code'    => Auth::user()->group_code,
        ])->first() != null;
    }
}