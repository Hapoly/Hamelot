<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    protected $primary = 'id';
    protected $table = 'report_temapltes';
    protected $fillable = ['title', 'description', 'status'];

    const S_ACTIVE      = 1;
    const S_INACTIVE    = 2;

    public function getStatusStrAttribute(){
        return __('reports.status_str.' . $this->status);
    }
}
