<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Permission extends Model
{
    protected $primary = 'id';
    protected $table = 'permissions';
    protected $fillable = ['patient_id', 'doctor_id', 'status'];

    public function patient(){
        return $this->belongsTo('App\Models\User', 'patient_id');
    }
    public function doctor(){
        return $this->belongsTo('App\Models\User', 'doctor_id');
    }


    const STATUS_PENDING    = 1;
    const STATUS_ACCEPTED   = 2;
    const STATUS_REFUSED    = 3;

    public function getStatusStrAttribute(){
        return __('permisisons.status_str.' . $this->status);
    }
}