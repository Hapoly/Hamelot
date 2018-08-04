<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Drivers\Time;

use URL;
use App\User;
use App\Models\ReportField;
use App\Models\Experiment;
use App\Models\ReportTemplate;
use App\Http\Requests\ExperimentRequest;

class Experiments extends Controller{
  public function index(Request $request){
    $experiments = new Experiment;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $experiments = $experiments->orderBy($request->input('sort'), 'desc');
      $experiments = $experiments->paginate(10);
      $links = $experiments->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $experiments = $experiments->whereHas('report_template', function($query){ return $query->where('title', 'LIKE', "%$search%");});
      $experiments = $experiments->paginate(10);
      $links = $experiments->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $experiments = $experiments->whereHas('report_template', function($query){ return $query->where('title', 'LIKE', "%$search%");});
      $experiments = $experiments->orderBy($request->input('sort'), 'desc');
      $experiments = $experiments->paginate(10);
      $links = $experiments->appends(['sort' => $request->input('sort')])->links();
    }else{
      $experiments = $experiments->paginate(10);
    }
    return view('panel.experiments.index', [
      'experiments' => $experiments,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Experiment $experiment){
    return view('panel.experiments.show', ['experiment' => $experiment]);
  }
  public function create(Request $request){
    $report_template = ReportTemplate::find($request->input('report_template', 0));
    if(!$report_template)
      abort(404);
    return view('panel.experiments.create', [
      'report_template' => $report_template,
      'patients'        => Auth::user()->patients(),
    ]);
  }
  public function store(ExperimentRequest $request){
    $patient = User::getByName($request->patient_name);
    if(!$patient)
      abort(404);
    $inputs = $request->all();
    $inputs['user_id'] = $patient->id;
    $inputs['date'] = Time::jmktime(0, 0, 0, $inputs['day'], $inputs['month'], $inputs['year']);
    $experiment = Experiment::create($inputs);
    $experiment->saveFields($request);
    return redirect()->route('panel.experiments.show', ['experiment' => $experiment]);
  }
  public function edit(Experiment $experiment){
    return view('panel.experiments.edit', [
      'patients'        => Auth::user()->patients(),
      'experiment'      => $experiment,
    ]);
  }
  public function update(ExperimentRequest $request, Experiment $experiment){
    $patient = User::getByName($request->patient_name);
    if(!$patient)
      abort(404);
    $inputs = $request->all();
    $inputs['user_id'] = $patient->id;
    $inputs['date'] = Time::jmktime(0, 0, 0, $inputs['day'], $inputs['month'], $inputs['year']);
    $experiment->fill($inputs)->save();
    $experiment->saveFields($request);
    return redirect()->route('panel.experiments.show', ['experiment' => $experiment]);
  }
  public function destroy(Experiment $experiment){
    $experiment->delete();
    if(URL::route('panel.experiments.show', ['experiment' => $experiment]) == URL::previous())
      return redirect()->route('panel.experiments.index');
    else
      return redirect()->back();
  }
}
