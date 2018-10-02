<?php

namespace App;

use App\UModel;


class DemandEventAttachment extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'demand_attachments';
    protected $fillable = ['image', 'caption', 'demand_event_id'];

    public function demand_event(){
        return $this->belongTo('App\DemandEvent');
    }
}
