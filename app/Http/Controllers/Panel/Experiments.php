<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\ReportField;
use App\Models\ReportTemplate;
use App\Http\Requests\ReportTemplateRequest;

class Experiments extends Controller{
  public function index(Request $request){
    $report_templates = new ReportTemplate;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $report_templates = $report_templates->orderBy($request->input('sort'), 'desc');
      $report_templates = $report_templates->paginate(10);
      $links = $report_templates->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $report_templates = $report_templates->where('title', 'LIKE', "%$search%");
      $report_templates = $report_templates->paginate(10);
      $links = $report_templates->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $report_templates = $report_templates->where('title', 'LIKE', "%$search%");
      $report_templates = $report_templates->orderBy($request->input('sort'), 'desc');
      $report_templates = $report_templates->paginate(10);
      $links = $report_templates->appends(['sort' => $request->input('sort')])->links();
    }else{
      $report_templates = $report_templates->paginate(10);
    }
    return view('panel.report_templates.index', [
      'report_templates'   => $report_templates,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(ReportTemplate $report_template){
    return view('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function create(){
    return view('panel.report_templates.create');
  }
  public function store(ReportTemplateRequest $request){
    $report_template = ReportTemplate::create([
      'title'         => $request->title,
      'description'   => $request->description,
      'status'        => $request->status,
    ]);
    $report_template->saveFields($request);
    return redirect()->route('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function edit(ReportTemplate $report_template){
    return view('panel.report_templates.edit', ['report_template' => $report_template]);
  }
  public function update(ReportTemplateRequest $request, ReportTemplate $report_template){
    $inputs = $request->all();
    $report_template->fill($inputs)->save();
    $report_template->saveFields($request);
    return redirect()->route('panel.report_templates.show', ['report_template' => $report_template]);
  }
  public function destroy(ReportTemplate $report_template){
    $report_template->delete();
    if(URL::route('panel.report_templates.show', ['report_template' => $report_template]) == URL::previous())
      return redirect()->route('panel.report_templates.index');
    else
      return redirect()->back();
  }
}
