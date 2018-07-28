<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Drivers\Time;
use App\Models\ConstValue;

class Patient extends Model
{
    protected $primary = 'id';
    protected $table = 'patients';
    protected $fillable = ['gender', 'id_number', 'profile', 'user_id', 'birth_date'];
    protected $visible = ['profile_url', 'birth_date_str', 'age', 'age_str', 'birth_year', 'birth_month', 'birth_day'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getGenderStrAttribute(){
        return ConstValue::find($this->gender)->value;
    }
    public function getBirthDateStrAttribute(){
        return Time::jdate('d F Y', $this->birth_date);
    }

    public function getBirthYearAttribute(){
        return Time::jdate('Y', $this->birth_date);
    }
    public function getBirthMonthAttribute(){
        return intval(Time::jdate('m', $this->birth_date));
    }
    public function getBirthDayAttribute(){
        return intval(Time::jdate('d', $this->birth_date));
    }

    public function getAgeAttribute(){
        return intval((time() - $this->birth_date)/(3600*24*30*12));
    }
    public function getAgeStrAttribute(){
        return intval((time() - $this->birth_date)/(3600*24*30*12)) . ' سال';
    }
    public function getProfileUrlAttribute(){
        if($this->profile == 'NuLL')
            if($this->gender == 19)
                return url('defaults\male.png');
            else
                return url('defaults\female.png');
        else
            return url($this->profile);
    }
}
