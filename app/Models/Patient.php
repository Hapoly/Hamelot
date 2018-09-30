<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Drivers\Time;
use App\Models\ConstValue;

class Patient extends Model
{
    protected $primary = 'id';
    protected $table = 'patients';
    protected $fillable = ['gender', 'id_number', 'profile', 'user_id', 'birth_date'];

    public function user(){
        return $this->belongsTo('App\User');
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

    const MALE      = 1;
    const FEMALE    = 2;
    public function getGenderStrAttribute(){
        return __('users.gender_str.' . $this->gender);
    }
    public function getProfileUrlAttribute(){
        if($this->profile == 'NuLL')
            if($this->gender == Patient::MALE)
                return url('defaults\male.png');
            else
                return url('defaults\female.png');
        else
            return url($this->profile);
    }

    public function getIdNumberStrAttribute(){
        if($this->id_number)
            return $this->id_number;
        else
            return ' - ';
    }

    public function delete(array $options =[]){
        Storage::disk('public')->delete($this->profile);
        parent::delete($options);
    }
}
