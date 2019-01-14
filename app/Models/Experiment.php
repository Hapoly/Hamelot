<?php

namespace App\Models;

use App\UModel;

class Experiment extends UModel {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'experiments';
  protected $fillable = ['demand_id', 'report_template_id', 'patient_id', 'unit_id', 'unit_title', 'status'];

  const ACTIVE = 1;
  const INACTIVE = 2;

  public function getStatusStrAttribute() {
    return __('eperiments.status_str.' . $this->status);
  }

  public function demand() {
    return $this->belongsTo('App\Models\Demand', 'demand_id');
  }
  public function report_template() {
    return $this->belongsTo('App\Models\ReportTemplate', 'report_template_id');
  }
  public function patient() {
    return $this->belongsTo('App\User', 'patient_id');
  }
  public function unit() {
    return $this->belongsTo('App\Models\Unit', 'unit_id');
  }
  public function getUnitTitleStrAttribute() {
    if ($this->unit_id == 'NuLL') {
      return $this->unit_title;
    } else {
      return $this->unit->complete_title;
    }

  }
}
