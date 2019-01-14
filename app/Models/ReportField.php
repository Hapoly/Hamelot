<?php

namespace App;

use App\UModel;

class ReportField extends UModel {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'report_fields';
  protected $fillable = ['report_id', 'field_id'];

  public function report_template() {
    return $this->belongsTo('App\Models\ReportTemplate', 'report_id');
  }
  public function field_template() {
    return $this->belongsTo('App\Models\FieldTemplate', 'field_id');
  }
}
