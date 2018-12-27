<?php

namespace App\Models;

use App\UModel;
use App\Drivers\Time;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ActivityTime extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'activity_times';
    protected $fillable = [
        'day_of_week', 'unit_user_id', 
        'start_time', 'finish_time', 'just_in_unit_visit',
        'demand_limit', 'default_price', 'default_deposit', 'default_demand_time', 'auto_fill', 
        'status'];

    const ACTIVE = 1;
    const DEACTIVE = 2;
    public function getStatusStrAttribute(){
        return __('activity_times.status_str.' . $this->status);
    }
    public function unit_user(){
        return $this->belongsTo('App\Models\UnitUser');
    }

    public function getTimeStrAttribute(){
        $day_of_week = $this->day_of_week_str;
        return "$day_of_week " . $this->day_less_time_str;
    }
    public function getDayLessTimeStrAttribute(){
        return Time::jdate('H:i', $this->start_time - 3600*3.5) . " تا " . Time::jdate('H:i', $this->finish_time - 3600*3.5);
    }

    public function getDayOfWeekStrAttribute(){
        return __('general.day_of_week.' . $this->day_of_week);
    }

    public static function fetch(){
        if(Auth::user()->isAdmin())
            return new ActivityTime;
        else if(Auth::user()->isManager()){
            return ActivityTime::whereHas('unit_user', function($query){
                return $query->whereHas('unit', function($query){
                    return $query->whereHas('managers', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                });
            });
        }else if(Auth::user()->isSecretary()){
            return ActivityTime::whereHas('unit_user', function($query){
                return $query->whereHas('unit', function($query){
                    return $query->whereHas('secretaries', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                });
            });
        }else
            return ActivityTime::whereHas('unit_user', function($query){
                return $query->where('user_id', Auth::user()->id);
            });
    }

    const AUTO_FILL_TRUE = 1;
    const AUTO_FILL_FALSE = 0;
    public function getAutoFillStrAttribute(){
        return __('activity_times.auto_fill_str.' . $this->auto_fill);
    }

    public function getDefaultPriceStrAttribute(){
        if($this->default_price == 0)
            return __('general.free');
        else
            return $this->default_price . ' ' . __('general.tmn');
    }
    public function getDefaultDepositStrAttribute(){
        if($this->default_deposit == 0)
            return __('general.free');
        else
            return $this->default_deposit . ' ' . __('general.tmn');
    }

    public function getDemandLimitStrAttribute(){
        if($this->demand_limit == 0)
            return __('general.unlimit');
        else
            return $this->demand_limit . ' ' . __('general.person');
    }
    public function getDefaultDemandTimeStrAttribute(){
        if($this->default_demand_time == 0)
            return __('general.unlimit');
        else
            return $this->default_demand_time . ' ' . __('general.minute');
    }

    const UNIT_ADDRESS  = 1;
    const IN_ADDRESS    = 2;
    const IN_UNIT       = 3;
    public function getJustInUnitVistStrAttribute(){
        return __('activity_times.just_in_unit_visit_str.' . $this->just_in_unit_visit);
    }
}