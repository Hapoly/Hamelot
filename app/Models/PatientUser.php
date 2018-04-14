<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientUser extends Model
{
    protected $primary = 'id';
    protected $table = 'patient_users';
    protected $fillable = ['patient_id', 'user_id'];
}
