<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperimentField extends Model
{
    protected $primary = 'id';
    protected $table = 'experiment_fields';
    protected $fillable = ['report_field_id', 'experiment_id', 'value_integer', 'value_string', 'value_decimal', 'value_boolean'];
}
