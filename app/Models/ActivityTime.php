<?php

namespace App\Models;

use App\UModel;

use Illuminate\Database\Eloquent\Model;

class ActivityTime extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'activity_times';
    protected $fillable = ['day_of_week', 'unit_user_id', 'start_time', 'finish', 'status'];

    public function unit_user(){
        return $this->belongsTo('App\Models\UnitUser');
    }

    public function getStartTimeStrAttribute(){
        return Time::jdate('H:i', $this->start_time);
    }

    public function getFinishTimeStrAttribute(){
        return Time::jdate('H:i', $this->finish_time);
    }
}
