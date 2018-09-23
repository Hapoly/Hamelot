<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $primary = 'id';
    protected $table = 'demands';
    protected $fillable = ['description', 'patient_id', 'status'];

    public function patient(){
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }

    const PENDING   = 1;
    const DOING     = 2;
    const DONE      = 3;
    const CANCELED  = 4;
    public function getStatusStrAttribute(){
        return __('demands.status_str.' . $this->status);
    }
}
