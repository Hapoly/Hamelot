<?php

namespace App\Models;

use App\UModel;

class ExperimentField extends UModel {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'experiment_fields';
  protected $fillable = ['value', 'field_template_id', 'experiment_id'];

  public function field_template() {
    return $this->belongsTo('App\Models\FieldTemplate', 'field_template_id');
  }
  public function experiment() {
    return $this->belongsTo('App\Models\Experiment', 'experiment_id');
  }
  public function value_url() {
    return url($this->value);
  }
}
