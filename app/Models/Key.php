<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $primary = 'id';
    protected $table = 'keys';
    protected $fillable = ['title', 'description', 'status', 'type', 'template_id'];
    
    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function status_str(){
        return __('key.status.' . $this->status);
    }


    const T_INTEGER     = 1;
    const T_STRING      = 2;
    const T_BOOLEAN     = 3;
    public function type_str(){
        return __('key.type.' . $this->type);
    }

    public function template(){
        return $this->belongsTo('App\Models\Template');
    }
}
