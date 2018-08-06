<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExperimentField;
use App\Drivers\Time;
use Storage;

class Experiment extends Model
{
    protected $primary = 'id';
    protected $table = 'experiments';
    protected $fillable = ['user_id', 'report_template_id', 'date', 'status'];

    const STATUS_ACTIVE     = 1;
    const STATIC_INCACTIVE  = 2;
    public function getStatusStrAttribute(){
        return __('experiments.status_str.' . $this->status);
    }

    public function report_template(){
        return $this->belongsTo('App\Models\ReportTemplate');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function departments(){
        return $this->belongsToMany('App\Models\Department');
    }
    public function fields(){
        return $this->hasMany('App\Models\ExperimentField');
    }
    public function field(ReportField $report_field){
        return $this->fields()->where('report_field_id', $report_field->id)->first();
    }
    public function field_value(ReportField $report_field){
        if($this->field($report_field))
            return $this->field($report_field)->value;
        else
            return '';
    }
    public function getDateStrAttribute(){
        return Time::jdate('d F Y', $this->date);
    }
    public function saveFields($request){
        ExperimentField::where('experiment_id', $this->id)->delete();
        foreach($this->report_template->fields as $field){
            if($field->isImage()){
                $eField = [
                    'experiment_id'     => $this->id,
                    'report_field_id'   => $field->id,
                ];
                $eField['value_image'] = Storage::put('public/experiments', $request->file('field_' . $field->id));
                ExperimentField::create($eField);
            }else{
                $field_value = $request->input('field_' . $field->id, 'NuLL');
                if($field_value != 'NuLL'){
                    $eField = [
                        'experiment_id'     => $this->id,
                        'report_field_id'   => $field->id,
                    ];
                    if($field->isInteger())
                        $eField['value_integer'] = $field_value;
                    if($field->isString())
                        $eField['value_string'] = $field_value;
                    if($field->isFloat())
                        $eField['value_float'] = $field_value;
                    if($field->isBoolean()){
                        $eField['value_boolean'] = $field_value == 1;
                    }
                    ExperimentField::create($eField);
                }
            }
        }
    }
}
