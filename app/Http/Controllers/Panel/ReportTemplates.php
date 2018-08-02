<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Hospital;
use App\Models\Department;
use App\Http\Requests\ReportTemplateRequest;

class ReportTemplates extends Controller{
  public function index(Request $request){
    return 'test';
    $report_templates = new Department;
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
  public function show(Department $department){
    return view('panel.report_templates.show', ['department' => $department]);
  }
  public function create(){
    return view('panel.report_templates.create');
  }
  public function store(ReportTemplateRequest $request){
    return $request->all();
    $department = Department::create($request->all());
    return redirect()->route('panel.report_templates.show', ['department' => $department]);
  }
  public function edit(Department $department){
    return view('panel.report_templates.edit', ['department' => $department, 'hospitals' => Hospital::where('status', Hospital::S_ACTIVE)->get()]);
  }
  public function update(ReportTemplateRequest $request, Department $department){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/report_templates', $request->file('image'));
    $department->fill($inputs)->save();
    return redirect()->route('panel.report_templates.show', ['department' => $department]);
  }
  public function destroy(Department $department){
    $department->delete();
    if(URL::route('panel.report_templates.show', ['department' => $department]) == URL::previous())
      return redirect()->route('panel.report_templates.index');
    else
      return redirect()->back();
  }
}
