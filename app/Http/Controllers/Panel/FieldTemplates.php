<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Template\FieldCreate as FieldTemplateCreateRequest;
use App\Http\Requests\Template\FieldEdit as FieldTemplateEditRequest;
use App\Models\FieldTemplate;
use Illuminate\Http\Request;
use URL;

class FieldTemplates extends Controller {
  public function index(Request $request) {
    $field_templates = new FieldTemplate;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if ($sort != '###' && $search == '###') {
      $field_templates = $field_templates->orderBy($request->input('sort'), 'desc');
      $field_templates = $field_templates->paginate(10);
      $links = $field_templates->appends(['sort' => $request->input('sort')])->links();
    } else if ($sort == '###' && $search != '###') {
      $field_templates = $field_templates->where('title', 'LIKE', "%$search%");
      $field_templates = $field_templates->paginate(10);
      $links = $field_templates->appends(['sort' => $request->input('sort')])->links();
    } else if ($sort != '###' && $search != '###') {
      $field_templates = $field_templates->where('title', 'LIKE', "%$search%");
      $field_templates = $field_templates->orderBy($request->input('sort'), 'desc');
      $field_templates = $field_templates->paginate(10);
      $links = $field_templates->appends(['sort' => $request->input('sort')])->links();
    } else {
      $field_templates = $field_templates->paginate(10);
    }

    return view('panel.field_templates.index', [
      'field_templates' => $field_templates,
      'links' => $links,
      'sort' => $sort,
      'search' => $search,
      'experiment_for_bid' => $request->has('bid'),
      'bid' => $request->input('bid', 0),
    ]);
  }
  public function show(FieldTemplate $report_template) {
    return view('panel.field_templates.show', ['report_template' => $report_template]);
  }
  public function create() {
    return view('panel.field_templates.create');
  }
  public function store(FieldTemplateCreateRequest $request) {
    $report_template = new FieldTemplate;
    $report_template->fill($request->only([
      'title', 'description', 'status',
    ]))->save();
    // $report_template->saveFields($request);
    
    return redirect()->route('panel.field_templates.show', ['report_template' => $report_template]);
  }
  public function edit(FieldTemplate $report_template) {
    return view('panel.field_templates.edit', ['report_template' => $report_template]);
  }
  public function update(FieldTemplateEditRequest $request, FieldTemplate $report_template) {
    $inputs = $request->all();
    $report_template->fill($inputs)->save();
    $report_template->saveFields($request);
    return redirect()->route('panel.field_templates.show', ['report_template' => $report_template]);
  }
  public function destroy(FieldTemplate $report_template) {
    $report_template->delete();
    if (URL::route('panel.field_templates.show', ['report_template' => $report_template]) == URL::previous()) {
      return redirect()->route('panel.field_templates.index');
    } else {
      return redirect()->back();
    }

  }
}
