<?php

namespace App;

use App\UModel;


class DemandEvent extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
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
