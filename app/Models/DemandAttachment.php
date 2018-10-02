<?php

namespace App;

use App\UModel;


class DemandAttachemtn extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'demand_events';
    protected $fillable = ['demand_id', 'image', 'caption'];

    public function demand(){
        return $this->belongsToMany('App\Models\Demand');
    }
    public function getImageUrlAttribute(){
        return url($this->image);
    }
    public function delete(array $options = []){
        Storage::disk('public')->delete($this->image);
        parent::delete($options);
    }
}
