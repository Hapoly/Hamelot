<?php

namespace App\Models;

use App\UModel;
use App\Models\Entry;
use Webpatser\Uuid\Uuid;

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
      'group_code' => Entry::REPORT_TEMPLATE,
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
    ReportField::where('report_id', $this->id)->delete();
    Entry::where('target_id', $this->id)->delete();
    parent::delete();
  }
}
