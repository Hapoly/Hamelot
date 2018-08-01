<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $primary = 'id';
    protected $table = 'experiments';
    protected $fillable = ['user_id', 'report_template_id', 'date', 'status'];

    const STATUS_ACTIVE     = 1;
    const STATIC_INCACTIVE  = 2;
    public function getStatusStrAttribute(){
        return __('experiments.status_str.' . $this->status);
    }

    public function report_template(){
        return $this->belongsTo('App\Models\ReportTemplate');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function departments(){
        return $this->belongsToMany('App\Models\Department');
    }
}
