<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentPatient extends Model
{
    protected $primary = 'id';
    protected $table = 'department_patients';
    protected $fillable = ['department_id', 'patient_id'];
}
