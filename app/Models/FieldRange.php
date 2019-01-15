<?php

namespace App;

use App\UModel;

class FieldRange extends UModel {
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  protected $primary = 'id';
  protected $table = 'field_ranges';
  protected $fillable = ['value', 'min_age', 'max_age', 'min_weight', 'max_weight', 'gender', 'field_template_id', 'description'];

  public function field_template(){
    return $this->belongsTo('App\Models\FieldTemplate', 'field_template_id');
  }
}
