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
  public function experiments(Request $request){
    $experiments = Experiment::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->has('first_name'))
      $experiments = $experiments->whereRaw("first_name LIKE '%". $request->first_name ."%'");
    if($request->has('last_name'))
      $experiments = $experiments->whereRaw("last_name LIKE '%". $request->last_name ."%'");
    if($request->has('group_code'))
      $experiments = $experiments->whereRaw("group_code LIKE '%". $request->group_code ."%'");
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
