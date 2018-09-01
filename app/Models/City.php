<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primary = 'id';
    protected $table = 'cities';
    protected $fillable = ['title', 'province_id'];

    public function province(){
        return $this->belongsTo('App\Models\Province');
    }
}
