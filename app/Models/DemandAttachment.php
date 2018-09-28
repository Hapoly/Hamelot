<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandAttachemtn extends Model
{
    protected $primary = 'id';
    protected $table = 'demand_events';
    protected $fillable = ['demand_id', 'image', 'caption'];

    public function demand(){
        return $this->belongsToMany('App\Models\Demand');
    }
    public function getImageUrlAttribute(){
        return url($this->image);
    }
}
