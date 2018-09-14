<?php

namespace App\Http\Controllers\Panel\Prints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Experiment;

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
    if($request->has('page')){
      if($request->page != 0)
        $experiments = $experiments->paginate(10);  
      else
        $experiments = $experiments->get();
    }else
      $experiments = $experiments->paginate(10);
    return view('panel.prints.experiments.index', [
      'experiments'  => $experiments,
    ]);
  }
  public function show(Experiment $experiment){
    return view('panel.prints.experiments.show', [
      'experiment'  => $experiment,
    ]);
  }
  public function visitors(Experiment $experiment){
    return view('panel.prints.experiments.visitors', [
      'experiment'  => $experiment,
    ]);
  }
  public function experimentInfo(Experiment $experiment){
    return view('panel.prints.experiments.info', [
      'experiment'  => $experiment,
    ]);
  }
  public function units(Experiment $experiment){
    return view('panel.prints.experiments.units', [
      'experiment'  => $experiment,
    ]);
  }
}
