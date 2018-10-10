<?php

namespace App\Models;

use App\UModel;

use Illuminate\Database\Eloquent\Model;

class OffTime extends Model
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
}
