<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Template\ReportCreate as ReportTemplateCreateRequest;
use App\Http\Requests\Template\ReportEdit as ReportTemplateEditRequest;
use App\Models\ReportTemplate;
use App\Models\ReportField;
use App\Models\FieldTemplate;
use Illuminate\Http\Request;
use URL;

class ReportTemplates extends Controller {
  public function index(Request $request) {
    $report_templates = new ReportTemplate;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if ($sort != '###' && $search == '###') {
      $report_templates = $report_templates->orderBy($request->input('sort'), 'desc');
      $report_templates = $report_templates->paginate(10);
      $links = $report_templates->appends(['sort' => $request->input('sort')])->links();
    } else if ($sort == '###' && $search != '###') {
      $report_templates = $report_templates->where('title', 'LIKE', "%$search%");
      $report_templates = $report_templates->paginate(10);
      $links = $report_templates->appends(['sort' => $request->input('sort')])->links();
    } else if ($sort != '###' && $search != '###') {
      $report_templates = $report_templates->where('title', 'LIKE', "%$search%");
      $report_templates = $report_templates->orderBy($request->input('sort'), 'desc');
      $report_templates = $report_templates->paginate(10);
      $links = $report_templates->appends(['sort' => $request->input('sort')])->links();
    } else {
      $report_templates = $report_templates->paginate(10);
    }

    return view('panel.report_templates.index', [
      'report_templates' => $report_templates,
      'links' => $links,
      'sort' => $sort,
      'search' => $search,
      'experiment_for_bid' => $request->has('bid'),
      'bid' => $request->input('bid', 0),
    ]);
  }
  public function show(ReportTemplate $report_template) {
    return view('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function create() {
    return view('panel.report_templates.create');
  }
  public function store(ReportTemplateCreateRequest $request) {
    $report_template = new ReportTemplate;
    $report_template->fill($request->only([
      'title', 'description', 'status',
    ]))->save();
    
    $field_titles = explode(', ', $request->input('fields', ''));
    foreach($field_titles as $field_title){
      $field_title = str_replace(',', '', $field_title);
      $field_template = FieldTemplate::where('title', 'LIKE', '%'.$field_title.'%')->first();
      if($field_template){
        if(ReportField::where('field_id', $field_template->id)->where('report_id', $report_template->id)->first() == null)
          ReportField::create([
            'field_id' => $field_template->id,
            'report_id' => $report_template->id,
          ]);
      }
    }
    return redirect()->route('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function edit(ReportTemplate $report_template) {
    return view('panel.report_templates.edit', ['report_template' => $report_template]);
  }
  public function update(ReportTemplateEditRequest $request, ReportTemplate $report_template) {
    $report_template->fill($request->only([
      'title', 'description', 'status',
    ]))->save();
    
    Reportfield::where('report_id', $report_template->id)->delete();
    $field_titles = explode(', ', $request->input('fields', ''));
    foreach($field_titles as $field_title){
      $field_title = str_replace(',', '', $field_title);
      $field_template = FieldTemplate::where('title', 'LIKE', '%'.$field_title.'%')->first();
      if($field_template){
        if(ReportField::where('field_id', $field_template->id)->where('report_id', $report_template->id)->first() == null)
          ReportField::create([
            'field_id' => $field_template->id,
            'report_id' => $report_template->id,
          ]);
      }
    }
    return redirect()->route('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function destroy(ReportTemplate $report_template) {
    $report_template->delete();
    if (URL::route('panel.report_templates.show', ['report_template' => $report_template]) == URL::previous()) {
      return redirect()->route('panel.report_templates.index');
    } else {
      return redirect()->back();
    }
  }

  public function removeField(Request $request, ReportField $report_field){
    $report_field->delete();
    return redirect()->back();
  }
}
