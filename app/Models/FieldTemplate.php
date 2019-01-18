<?php

namespace App\Models;

use App\UModel;
use Webpatser\Uuid\Uuid;
use App\Models\Entry;

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
    return __('field_templates.status_str.' . $this->status);
  }

  const NUMBER = 1;
  const TEXT = 2;
  const DECIMAL = 3;
  const IMAGE = 4;
  public function getTypeStrAttribute() {
    return __('field_templates.type_str.' . $this->type);
  }

  public function ranges() {
    return $this->hasMany('App\Models\FieldRange');
  }

  public function save(array $options = []) {
    if (!$this->id) {
      $this->id = Uuid::generate()->string;
    }
    parent::save($options);
    $entry = Entry::where('target_id', $this->id)->first();
    $data = [
      'target_id' => $this->id,
      'title' => $this->title,
      'slug' => $this->id,
      'lon' => 0,
      'lat' => 0,
      'city_id' => 0,
      'province_id' => 0,
      'group_code' => Entry::FIELD_TEMPLATE,
      'type' => Entry::VIRTUAL,
      'public' => $this->status == FieldTemplate::ACTIVE? Entry::T_PUBLIC: Entry::T_PRIVATE
    ];
    if ($entry) {
      $entry->fill($data);
      $entry->save();
    } else {
      Entry::create($data);
    }
  }

  public function delete() {
    FieldRange::where('field_template_id', $this->id)->delete();
    ReportField::where('field_id', $this->id)->delete();
    parent::delete();
  }
}
