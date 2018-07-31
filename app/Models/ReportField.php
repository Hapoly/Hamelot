<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportField extends Model
{
    protected $primary = 'id';
    protected $table = 'report_fields';
    protected $fillable = ['title', 'description', 'type', 'label', 'report_template_id', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('reports.status_str.' . $this->status);
    }

    const T_INTEGER     = 1;
    const T_STRING      = 2;
    const T_FLOAT       = 3;
    const T_BOLLEAN     = 4;
    public function getTypeStrAttribute(){
        return __('reports.type_str.' . $this->type);
    }

}
