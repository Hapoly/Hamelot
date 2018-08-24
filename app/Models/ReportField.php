<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportField extends Model
{
    protected $primary = 'id';
    protected $table = 'report_fields';
    protected $fillable = ['title', 'quantity', 'description', 'type', 'label', 'report_template_id', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('reports.status_str.' . $this->status);
    }

    const T_INTEGER     = 1;
    const T_STRING      = 2;
    const T_FLOAT       = 3;
    const T_BOLLEAN     = 4;
    const T_IMAGE       = 5;
    public function getTypeStrAttribute(){
        return __('reports.type_str.' . $this->type);
    }

    public function isInteger(){
        return $this->type == ReportField::T_INTEGER;
    }
    public function isString(){
        return $this->type == ReportField::T_STRING;
    }
    public function isFloat(){
        return $this->type == ReportField::T_FLOAT;
    }
    public function isBoolean(){
        return $this->type == ReportField::T_BOLLEAN;
    }
    public function isImage(){
        return $this->type == ReportField::T_IMAGE;
    }
    public function getQuantityStrAttribute(){
        if($this->quantity == 'NuLL')
            return '-';
        else
            return $this->quantity;
    }
}
