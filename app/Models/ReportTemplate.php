<?php

namespace App\Models;

use App\UModel;

use App\Models\ReportField;

class ReportTemplate extends UModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'report_templates';
    protected $fillable = ['title', 'description', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('reports.status_str.' . $this->status);
    }

    public function fields(){
        return $this->hasMany('App\Models\ReportField');
    }
    public function saveFields($request){
        ReportField::where('report_template_id', $this->id)->delete();

        for($i=0; $i<sizeof($request->titles); $i++){
            ReportField::create([
            'title'               => $request->input("titles.$i"),
            'description'         => $request->input("descriptions.$i"),
            'type'                => $request->input("types.$i"),
            'label'               => $request->input("labels.$i") != ''? $request->input("labels.$i", 'NuLL'): 'NuLL',
            'report_template_id'  => $this->id,
            ]);
        }
    }
    public function getFieldCountAttribute(){
        return $this->fields()->count();
    }
}
