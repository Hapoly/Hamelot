<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Drivers\Time;

class Permission extends Model
{
    protected $primary = 'id';
    protected $table = 'permissions';
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
        return $this->status_lang[$this->status];
    }
    public function getStatusStrWithDateAttribute(){
        if($this->pending())
            return $this->status_str;
        else
            return $this->status_lang[$this->status] . ' در ' . Time::jdate('d F Y', strtotime($this->updated_at));
    }
    public function getDateStrAttribute(){
        if($this->pending())
            return Time::jdate('d F Y', strtotime($this->created_at));
        else
            return Time::jdate('d F Y', strtotime($this->updated_at));
    }
    public function pending(){
        return $this->status == Permission::PENDING;
    }
    public function accepted(){
        return $this->status == Permission::ACCEPTED;
    }
    public function refused(){
        return $this->status == Permission::REFUSED;
    }
    public function canceled(){
        return $this->status == Permission::CANCELED;
    }

    public function canAccept(){
        return $this->pending() && (Auth::user()->isAdmin() || Auth::user()->id == $this->patient_id);
    }
    public function canRefuse(){
        return $this->pending() && (Auth::user()->isAdmin() || Auth::user()->id == $this->patient_id);
    }
    public function canCancel(){
        return Auth::user()->isAdmin() || Auth::user()->id == $this->patient_id || Auth::user()->id == $this->requester_id;
    }

    public static function fetch(){
        return Permission::where('patient_id', Auth::user()->id)->orWhere('requester_id' , Auth::user()->id);
    }
}
