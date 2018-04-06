<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Drivers\Time;

class Report extends Model
{
    protected $primary = 'id';
    protected $table = 'reports';
    protected $fillable = ['key_id', 'value', 'date', 'hospital_id', 'patient_id'];

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }
    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }
    public function key(){
      return $this->belongsTo('App\Models\Key');
    }

    public function date_stamp(){
        return Time::jdate('Y/n/d G:i', $this->created_at->timestamp);
    }
}
