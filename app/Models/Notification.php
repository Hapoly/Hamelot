<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primary = 'id';
    protected $table = 'notifications';
    protected $fillable = ['user_id', 'type', 'title', 'body', 'data', 'status'];
}
