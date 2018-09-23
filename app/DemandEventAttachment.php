<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandEventAttachment extends Model
{
    protected $primary = 'id';
    protected $table = 'demand_attachments';
    protected $fillable = ['image', 'caption', 'demand_event_id'];

    public function demand_event(){
        return $this->belongTo('App\DemandEvent');
    }
}
