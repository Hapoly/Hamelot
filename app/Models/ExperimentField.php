<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperimentField extends Model
{
    protected $primary = 'id';
    protected $table = 'experiment_fields';
    protected $fillable = ['report_field_id', 'experiment_id', 'value_integer', 'value_image', 'value_string', 'value_decimal', 'value_boolean'];

    public function report_field(){
        return $this->belongsTo('App\Models\ReportField');
    }
    public function getTitleAttribute(){
        return $this->report_field->title;
    }
    public function getValueAttribute(){
        if($this->report_field->isInteger())
            return $this->value_integer;
        if($this->report_field->isString())
            return $this->value_string;
        if($this->report_field->isBoolean())
            return $this->value_boolean;
        if($this->report_field->isFloat())
            return $this->value_decimal;
        if($this->report_field->isImage())
            return $this->value_image;
    }
    public function getLiteralValueAttribute(){
        if($this->report_field->isInteger())
            return $this->value_integer . ' ' . $this->report_field->quantity;
        if($this->report_field->isFloat())
            return $this->value_decimal . ' ' . $this->report_field->quantity;
        if($this->report_field->isImage())
            return url($this->value_image);
        if($this->report_field->isBoolean())
            return __('general.select_str.' . $this->value_boolean);
        if($this->report_field->isString())
            return $this->value_string;
    }
}
