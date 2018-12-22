<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\OffTime;
use App\User;
use App\Models\UnitUser;

use App\Http\Requests\OffTime\Create as OffTimeCreateRequest;
use App\Http\Requests\OffTime\Edit as OffTimeEditRequest;

class OffTimes extends Controller{
  public function index(Request $request){
    $off_times = OffTime::fetch();
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('unit_id') && $request->unit_id != '0'){
      $unit_id = $request->unit_id;
      $off_times = $off_times->whereHas('unit_user', function($query) use($unit_id){
        return $query->where('unit_id', $unit_id);
      });
    }
    if($request->has('sort'))
      $off_times = $off_times->orderBy($request->input('sort'), 'desc');
    $off_times = $off_times->paginate(10);
    
    return view('panel.off_times.index', [
      'off_times'   => $off_times,
      'links'       => $links,
      'sort'        => $sort,
      'units'       => Auth::user()->units,
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'     => [
        'unit_id'       => $request->input('unit_id', 0),
      ],
    ]);
  }
  public function show(Request $request, OffTime $off_time){
    return view('panel.off_times.show', ['off_time' => $off_time]);
  }
  public function create(Request $request){
    return view('panel.off_times.create');
  }
  public function store(OffTimeCreateRequest $request){
    $inputs = $request->all();
    $inputs['start_date'] /= 1000;
    $inputs['finish_date'] /= 1000;
    if(Auth::user()->isDoctor() || Auth::user()->isNurse())
      $inputs['user_id'] = Auth::user()->id;
    else
      $inputs['user_id'] = UnitUser::find($inputs['unit_user_id'])->user_id;
    $off_time = OffTime::create($inputs);
    return redirect()->route('panel.off-times.show', ['off_time' => $off_time]);
  }
  public function edit(OffTime $off_time){
    return view('panel.off_times.edit', [
      'off_time'   => $off_time,
    ]);
  }
  public function update(OffTimeEditRequest $request, OffTime $off_time){
    $inputs = $request->all();
    $inputs['start_date'] /= 1000;
    $inputs['finish_date'] /= 1000;
    if(Auth::user()->isDoctor() || Auth::user()->isNurse())
      $inputs['user_id'] = Auth::user()->id;
    else
      $inputs['user_id'] = UnitUser::find($inputs['unit_user_id'])->user_id;
    $off_time->fill($inputs)->save();
    return redirect()->route('panel.off-times.show', ['off_time' => $off_time]);
  }
  public function destroy(OffTime $off_time){
    $off_time->delete();
    if(URL::route('panel.off-times.show', ['off_time' => $off_time]) == URL::previous())
      return redirect()->route('panel.off-times.index');
    else
      return redirect()->back();
  }
}
