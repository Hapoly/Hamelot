<?php

namespace App\Http\Controlelrs\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Patient;
use App\Models\Hospital;

use App\Models\Template;
use App\Models\Key;
use App\Models\Report;
use App\Http\Requests\ReportRequest;

class Reports extends Controller{
  public function index(Request $request){
    $reports = new Report;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $reports = $reports->orderBy($request->input('sort'), 'desc');
      $reports = $reports->paginate(10);
      $links = $reports->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $reports = $reports->where('value', 'LIKE', "%$search%");
      $reports = $reports->paginate(10);
      $links = $reports->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $reports = $reports->where('value', 'LIKE', "%$search%");
      $reports = $reports->orderBy($request->input('sort'), 'desc');
      $reports = $reports->paginate(10);
      $links = $reports->appends(['sort' => $request->input('sort')])->links();
    }else{
      $reports = $reports->paginate(10);
    }
    return view('admin.reports.index', [
      'reports'     => $reports,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Report $report){
    return view('admin.reports.show', ['report' => $report]);
  }
  public function create(){
    return view('admin.reports.create', [
      'keys'      => Key::where('status', Key::S_ACTIVE)->get(),
      'hospitals' => Hospital::where('status', Hospital::S_ACTIVE)->get(),
      'patients'  => Patient::where('status', Patient::S_ACTIVE)->get(),
    ]);
  }
  public function store(ReportRequest $request){
    $report = Report::create($request->all());
    return redirect()->route('admin.reports.show', ['report' => $report]);
  }
  public function edit(Report $report){
    return view('admin.reports.edit', [
      'report'    => $report,
      'keys'      => Key::where('status', Key::S_ACTIVE)->get(),
      'hospitals' => Hospital::where('status', Hospital::S_ACTIVE)->get(),
      'patients'  => Patient::where('status', Patient::S_ACTIVE)->get(),
    ]);
  }
  public function update(ReportRequest $request, Report $report){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/reports', $request->file('image'));
    $report->fill($inputs)->save();
    return redirect()->route('admin.reports.show', ['report' => $report]);
  }
  public function destroy(Report $report){
    $report->delete();
    if(URL::route('admin.reports.show', ['report' => $report]) == URL::previous())
      return redirect()->route('admin.reports.index');
    else
      return redirect()->back();
  }
}
