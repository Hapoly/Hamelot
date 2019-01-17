<?php

namespace App\Models;

use App\UModel;

class ReportTemplate extends UModel {

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'report_templates';
  protected $fillable = ['title', 'description', 'status'];

  public function fields() {
    return $this->belongsToMany('App\Models\FieldTemplate', 'report_fields', 'report_id', 'field_id')
      ->using((new class extends \Illuminate\Database\Eloquent\Relations\Pivot {
        protected $casts = ['id' => 'string'];
      }))->withPivot('id');
  }

  const ACTIVE = 1;
  const INACTIVE = 2;
  public function getStatusStrAttribute() {
    return __('report_templates.status_str.' . $this->status);
  }
  public function getFieldsStrAttribute() {
    $fields = [];
    foreach ($this->fields as $field) {
      array_push($fields, $field->title);
    }

    return implode(', ', $fields);
  }
}
