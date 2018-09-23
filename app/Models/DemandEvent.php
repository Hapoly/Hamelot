<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandEvent extends Model
{
    protected $primary = 'id';
    protected $table = 'demand_events';
    protected $fillable = ['demand_id', 'experiment_id', 'price', 'status', 'authority', 'pay_type'];

    public function demand(){
        return $this->belongsToMany('App\Models\Demand');
    }

    public function experiment(){
        return $this->belongsTo('App\Models\Experiment');
    }
    

    const PENDING   = 1;
    const PAID      = 2;
    const CANCELED  = 3;
    const REJECTED  = 4;
}
