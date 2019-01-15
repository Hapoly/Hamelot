<?php

namespace App\Models;

use App\UModel;

class FieldTemplate extends UModel {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'field_templates';
  protected $fillable = ['title', 'description', 'status', 'type', 'unit'];

  public function report_templates() {
    return $this->belongsToMany('App\Models\ReportTemplate', 'report_fields', 'field_id', 'report_id');
  }

  const ACTIVE = 1;
  const INACTIVE = 2;
  public function getStatusStrAttribute() {
    return __('field_templates.status_str' . $this->status);
  }

  const NUMBER = 1;
  const TEXT = 2;
  const DECIMAL = 3;
  const IMAGE = 4;
}
