<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primary = 'id';
    protected $table = 'reports';
    protected $fillable = ['key', 'value', 'date', 'hospital_id', 'patient_id'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function status_str(){
        return __('report.status.' . $this->status);
    }
    public function patients(){
        return $this->belongsTo('App\Models\Patient');
    }
    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }
}
