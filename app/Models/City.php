<?php

namespace App\Models;

use App\UModel;


class City extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'cities';
    protected $fillable = ['title', 'province_id'];

    public function province(){
        return $this->belongsTo('App\Models\Province');
    }
}
