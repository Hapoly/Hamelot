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
use App\Models\Unit;
use App\Models\City;
use App\Models\Province;
use App\Http\Requests\ExperimentRequest;

class Experiments extends Controller{
  public function index(Request $request){
    $experiments = Experiment::fetch();
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('unit_id') && $request->unit_id != 0)
      $experiments = $experiments->where('unit_id', $request->unit_id);
    if($request->has('status') && $request->status != 0)
      $experiments = $experiments->where('status', $request->status);
    if($request->has('province_id') && $request->province_id != 0){
      if($request->has('city_id') && $request->city_id != 0){
        $city_id = $request->city_id;
        $experiments = $experiments->whereHas('unit', function($query) use($city_id){
          return $query->where('city_id', $city_id);
        });
      }else{
        $province_id = $request->province_id;
        $experiments = $experiments->whereHas('unit', function($query) use($province_id){
          return $query->whereHas('city', function($query) use ($province_id){
            return $query->where('province_id', $province_id);
          });
        });
      }
    }else{
      if($request->has('city_id') && $request->city_id != 0){
        $city_id = $request->city_id;
        $experiments = $experiments->whereHas('unit', function($query) use($city_id){
          return $query->where('city_id', $city_id);
        });
      }
    }
    if($request->has('sort'))
      $experiments = $experiments->orderBy($request->input('sort'), 'desc');
    $experiments = $experiments->paginate(10);
    
    return view('panel.experiments.index', [
      'experiments' => $experiments,
      'units'       => Auth::user()->units,
      'cities'      => City::all(),
      'provinces'   => Province::all(),
      'links'       => $links,
      'sort'        => $sort,
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'     => [
        'unit_id'     => $request->input('unit_id', ''),
        'province_id' => $request->input('province_id', ''),
        'city_id'     => $request->input('city_id', ''),
        'status'      => $request->input('status'),
      ],
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
      'patients'        => Auth::user()->patients()->get(),
      'units'           => Auth::user()->units()->get(),
    ]);
  }
  public function store(ExperimentRequest $request){
    $inputs = $request->all();
    $inputs['date'] = Time::jmktime(0, 0, 0, $inputs['day'], $inputs['month'], $inputs['year']);
    $experiment = Experiment::create($inputs);
    $experiment->saveFields($request);
    return redirect()->route('panel.experiments.show', ['experiment' => $experiment]);
  }
  public function edit(Experiment $experiment){
    return view('panel.experiments.edit', [
      'patients'        => Auth::user()->patients()->get(),
      'units'           => Auth::user()->units()->get(),
      'experiment'      => $experiment,
    ]);
  }
  public function update(ExperimentRequest $request, Experiment $experiment){
    $inputs = $request->all();
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
