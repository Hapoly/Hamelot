<?php

namespace App\Models;

use App\UModel;

use Illuminate\Database\Eloquent\Model;
use App\Drivers\Time;
use Auth;

class OffTime extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'off_times';
    protected $fillable = ['start_date', 'finish_date', 'unit_user_id', 'user_id'];

    public function unit_user(){
        return $this->belongsTo('App\Models\UnitUser');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getStartDateStrAttribute(){
        return Time::jdate('d F Y H:i', $this->start_date);
    }

    public function getFinishDateStrAttribute(){
        return Time::jdate('d F Y H:i', $this->finish_date);
    }

    public function getTimeStrAttribute(){
        return $this->start_date_str . ' - ' . $this->finish_date_str;
    }

    public static function fetch(){
        if(Auth::user()->isAdmin())
            return new OffTime;
        else if(Auth::user()->isManager())
            return OffTime::where(function($query){
                return $query->whereHas('unit_user', function($query){
                    return $query->whereHas('unit', function($query){
                        return $query->whereHas('managers', function($query){
                            return $query->where('users.id', Auth::user()->id);
                        });
                    });
                });
            });
        else if(Auth::user()->isSecretary())
            return OffTime::where(function($query){
                return $query->whereHas('unit_user', function($query){
                    return $query->whereHas('unit', function($query){
                        return $query->whereHas('secretaries', function($query){
                            return $query->where('users.id', Auth::user()->id);
                        });
                    });
                });
            });
        else{
            return OffTime::where('user_id', Auth::user()->id);
        }
    }

    public function getPermissionToWriteAttribute(){
        if(Auth::user()->isAdmin())
            return true;
        if(Auth::user()->isManager())
            return $this->unit_user->whereHas('unit', function($query){
                return $query->whereHas('managers', function($query){
                    return $query->where('users.id', Auth::user()->id);
                });
            })->first() != null;
        else
            return $this->user_id == Auth::user()->id;
    }
}