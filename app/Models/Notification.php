<?php

namespace App;

use App\UModel;


class Notification extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'notifications';
    protected $fillable = ['user_id', 'type', 'title', 'body', 'data', 'status'];
}
