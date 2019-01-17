<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Template\FieldCreate as FieldTemplateCreateRequest;
use App\Http\Requests\Template\FieldEdit as FieldTemplateEditRequest;
use App\Models\FieldRange;
use App\Models\FieldTemplate;
use Illuminate\Http\Request;
use URL;

class FieldTemplates extends Controller {
  public function index(Request $request) {
    $field_templates = new FieldTemplate;
    
    $field_templates = $field_templates->orderBy($request->input('sort', 'created_at'), 'desc');
    $field_templates = $field_templates->paginate(10);
    return view('panel.field_templates.index', [
      'field_templates' => $field_templates,
    ]);
  }
  public function show(FieldTemplate $field_template) {
    return view('panel.field_templates.show', ['field_template' => $field_template]);
  }
  public function create() {
    return view('panel.field_templates.create');
  }
  public function store(FieldTemplateCreateRequest $request) {
    $field_template = new FieldTemplate;
    $field_template->fill($request->only([
      'title', 'description', 'unit', 'type', 'status',
    ]))->save();
    $range_count = sizeof($request->input('values', []));
    for ($i = 0; $i < $range_count; $i++) {
      FieldRange::create([
        'value' => $request->input('values.' . $i),
        'max_age' => ($request->input('max_ages.' . $i) != null) ? $request->input('max_ages.' . $i) : 0,
        'min_age' => ($request->input('min_ages.' . $i) != null) ? $request->input('min_ages.' . $i) : 0,
        'max_weight' => ($request->input('max_weights.' . $i) != null) ? $request->input('max_weights.' . $i) : 0,
        'min_weight' => ($request->input('min_weights.' . $i) != null) ? $request->input('min_weights.' . $i) : 0,
        'gender' => $request->input('genders.' . $i),
        'description' => $request->input('descriptions.' . $i),
        'mode' => $request->input('modes.' . $i),
        'field_template_id' => $field_template->id,
      ]);
    }
    return redirect()->route('panel.field_templates.show', ['field_template' => $field_template]);
  }
  public function edit(FieldTemplate $field_template) {
    return view('panel.field_templates.edit', ['field_template' => $field_template]);
  }
  public function update(FieldTemplateEditRequest $request, FieldTemplate $field_template) {
    $field_template->fill($request->only([
      'title', 'description', 'unit', 'type', 'status',
    ]))->save();
    FieldRange::where('field_template_id', $field_template->id)->delete();
    $range_count = sizeof($request->input('values', []));
    for ($i = 0; $i < $range_count; $i++) {
      FieldRange::create([
        'value' => $request->input('values.' . $i),
        'max_age' => ($request->input('max_ages.' . $i) != null) ? $request->input('max_ages.' . $i) : 0,
        'min_age' => ($request->input('min_ages.' . $i) != null) ? $request->input('min_ages.' . $i) : 0,
        'max_weight' => ($request->input('max_weights.' . $i) != null) ? $request->input('max_weights.' . $i) : 0,
        'min_weight' => ($request->input('min_weights.' . $i) != null) ? $request->input('min_weights.' . $i) : 0,
        'gender' => $request->input('genders.' . $i),
        'description' => $request->input('descriptions.' . $i),
        'mode' => $request->input('modes.' . $i),
        'field_template_id' => $field_template->id,
      ]);
    }
    return redirect()->route('panel.field_templates.show', ['field_template' => $field_template]);
  }
  public function destroy(FieldTemplate $field_template) {
    $field_template->delete();
    if (URL::route('panel.field_templates.show', ['field_template' => $field_template]) == URL::previous()) {
      return redirect()->route('panel.field_templates.index');
    } else {
      return redirect()->back();
    }
  }
}
