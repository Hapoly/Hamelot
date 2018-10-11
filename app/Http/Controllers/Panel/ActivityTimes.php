<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\ActivityTime;
use App\User;
use App\Models\UnitUser;

use App\Http\Requests\ActivityTime\Create as ActivityTimeCreateRequest;
use App\Http\Requests\ActivityTime\Edit as ActivityTimeEditRequest;

class ActivityTimes extends Controller{
  public function index(Request $request){
    $activity_times = ActivityTime::fetch();
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('unit_id')){
      $unit_id = $request->unit_id;
      $activity_times = $activity_times->whereHas('unit_user', function($query) use($unit_id){
        return $query->where('unit_id', $unit_id);
      });
    }
    if($request->has('day_of_week'))
      $activity_times = $activity_times->where('day_of_week', $request->day_of_week);
    
    if($request->has('sort'))
      $activity_times = $activity_times->orderBy($request->input('sort'), 'desc');
    $activity_times = $activity_times->paginate(10);
    
    return view('panel.activity_times.index', [
      'activity_times'   => $activity_times,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'     => [
        'unit_id'     => $request->input('unit_id', ''),
        'day_of_week' => $request->input('day_of_week', ''),
      ],
    ]);
  }
  public function show(Request $request, ActivityTime $activity_time){
    return view('panel.activity_times.show', ['activity_time' => $activity_time]);
  }
  public function create(Request $request){
    return view('panel.activity_times.create');
  }
  public function store(ActivityTimeCreateRequest $request){
    $inputs = $request->all();
    $inputs['start_time'] = $request->start_timehour * 3600 + $request->start_timeminute * 60;
    $inputs['finish_time'] = $request->finish_timehour * 3600 + $request->finish_timeminute * 60;
    $activity_time = ActivityTime::create($inputs);
    return redirect()->route('panel.activity-times.show', ['activity_time' => $activity_time]);
  }
  public function edit(ActivityTime $activity_time){
    return view('panel.activity_times.edit', [
      'activity_time'   => $activity_time,
    ]);
  }
  public function update(ActivityTimeEditRequest $request, ActivityTime $activity_time){
    $inputs = $request->all();
    $inputs['start_time'] = $request->start_timehour * 3600 + $request->start_timeminute * 60;
    $inputs['finish_time'] = $request->finish_timehour * 3600 + $request->finish_timeminute * 60;
    $activity_time->fill($inputs)->save();
    return redirect()->route('panel.activity-times.show', ['activity_time' => $activity_time]);
  }
  public function destroy(ActivityTime $activity_time){
    $activity_time->delete();
    if(URL::route('panel.activity-times.show', ['activity_time' => $activity_time]) == URL::previous())
      return redirect()->route('panel.activity-times.index');
    else
      return redirect()->back();
  }
}
