<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Template\ReportCreate as ReportTemplateCreateRequest;
use App\Http\Requests\Template\ReportEdit as ReportTemplateEditRequest;
use App\Models\ReportTemplate;
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
    // $report_template->saveFields($request);
    
    return redirect()->route('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function edit(ReportTemplate $report_template) {
    return view('panel.report_templates.edit', ['report_template' => $report_template]);
  }
  public function update(ReportTemplateEditRequest $request, ReportTemplate $report_template) {
    $inputs = $request->all();
    $report_template->fill($inputs)->save();
    $report_template->saveFields($request);
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
}
