<?php

namespace App\Models;

use App\UModel;


class ConstValue extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'consts';
    protected $fillable = ['type', 'value'];

    const DOCTOR_FIELDS     = 1;
    const NURSE_FIELDS      = 2;

    public static function doctor_fields(){
        return ConstValue::where('type', ConstValue::DOCTOR_FIELD);
    }
    public static function nurse_fields(){
        return ConstValue::where('type', ConstValue::NURSE_FIELD);
    }
}
