<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primary = 'id';
    protected $table = 'permission';
    protected $fillable = ['requester_id', 'patient_id', 'status'];

    public function requester(){
        return $this->belongsTo('App\User', 'requester_id');
    }
    public function patient(){
        return $this->belongsTo('App\User', 'patient_id');
    }
    

    const PENDING   = 1;
    const ACCEPTED  = 2;
    const REFUSED   = 3;
    const CANCELED  = 4;
    private $status_lang = [
        1   => 'در انتظار',
        2   => 'تایید شده',
        3   => 'رد شده',
        4   => 'منقضی شده',
    ];
    public function getStatusStrAttribute(){
        return $this->ststus_lang[$this->status];
    }
}
