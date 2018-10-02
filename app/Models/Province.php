<?php

namespace App\Models;

use App\UModel;


class Province extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'provinces';
    protected $fillable = ['title'];

    public function cities(){
        return $this->hasMany('App\Models\Citiy');
    }
}
