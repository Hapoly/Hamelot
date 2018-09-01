<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primary = 'id';
    protected $table = 'provinces';
    protected $fillable = ['title'];

    public function cities(){
        return $this->hasMany('App\Models\Citiy');
    }
}
