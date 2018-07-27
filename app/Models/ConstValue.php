<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstValue extends Model
{
    protected $primary = 'id';
    protected $table = 'consts';
    protected $fillable = ['type', 'value'];

    const DOCTOR_DEGREE    = 1;
    const DOCTOR_FIELD     = 2;
    const NURSE_DEGREE     = 3;
    const NURSE_FIELD      = 4;
    const GENDER           = 5;


    public static function genders(){
        return ConstValue::where('type', ConstValue::GENDER);
    }
    public static function doctor_degrees(){
        return ConstValue::where('type', ConstValue::DOCTOR_DEGREE);
    }
    public static function doctor_fields(){
        return ConstValue::where('type', ConstValue::DOCTOR_FIELD);
    }
    public static function nurse_degrees(){
        return ConstValue::where('type', ConstValue::NURSE_DEGREE);
    }
    public static function nurse_fields(){
        return ConstValue::where('type', ConstValue::NURSE_FIELD);
    }
}
