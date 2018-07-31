<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalUser extends Model
{
    protected $primary = 'id';
    protected $table = 'hospital_user';
    protected $fillable = ['hospital_id', 'user_id'];
}
