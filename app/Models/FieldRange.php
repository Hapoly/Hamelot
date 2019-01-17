<?php

namespace App\Models;

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
  protected $fillable = ['mode', 'value', 'min_age', 'max_age', 'min_weight', 'max_weight', 'gender', 'field_template_id', 'description'];

  public function field_template() {
    return $this->belongsTo('App\Models\FieldTemplate', 'field_template_id');
  }

  const MAX = 1;
  const MIN = 2;
  public function getModeStrAttribute() {
    return __('field_ranges.mode_str.' . $this->mode);
  }

  public function getGenderStrAttribute() {
    return __('field_ranges.gender_str.' . $this->gender);
  }

  public function getAgePeriodStrAttribute() {
    if ($this->max_age == 0) {
      if ($this->min_age == 0) {
        return '';
      } else {
        return 'حداقل ' . $this->min_age . ' سال';
      }

    } else {
      if ($this->min_age == 0) {
        return 'حداکثر ' . $this->max_age . ' سال';
      } else {
        return 'بین ' . $this->min_age . ' تا ' . $this->max_age . ' سال';
      }

    }
  }

  public function getWeightPeriodStrAttribute() {
    if ($this->max_weight == 0) {
      if ($this->min_weight == 0) {
        return '';
      } else {
        return 'حداقل ' . $this->min_weight . ' کیلوگرم';
      }

    } else {
      if ($this->min_weight == 0) {
        return 'حداکثر ' . $this->max_weight . ' کیلوگرم';
      } else {
        return 'بین ' . $this->min_weight . ' تا ' . $this->max_weight . ' کیلوگرم';
      }
    }
  }

  public function getConditionStrAttribute() {
    $conditions = [];
    if ($this->gender != 1) {
      array_push($conditions, $this->gender_str);
    }

    if ($this->age_period_str != '') {
      array_push($conditions, $this->age_period_str);
    }

    if ($this->weight_period_str != '') {
      array_push($conditions, $this->weight_period_str);
    }
    if(sizeof($conditions) > 0)
      return 'در ' . implode(' و ', $conditions);
    else
      return '';
  }
}
