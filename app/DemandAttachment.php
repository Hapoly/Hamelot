<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandAttachment extends Model
{
    protected $primary = 'id';
    protected $table = 'demand_attachments';
    protected $fillable = ['image', 'caption', 'demand_id'];

    public function demand(){
        return $this->belongTo('App\Demand');
    }
}
