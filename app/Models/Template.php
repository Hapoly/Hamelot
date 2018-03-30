<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $primary = 'id';
    protected $table = 'templates';
    protected $fillable = ['title', 'description', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function status_str(){
        return __('templates.status_str.' . $this->status);
    }
    public function keys(){
        return $this->hasMany('App\Models\Key');
    }
}
