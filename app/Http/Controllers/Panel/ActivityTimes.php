<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityTime\Create as ActivityTimeCreateRequest;
use App\Http\Requests\ActivityTime\Edit as ActivityTimeEditRequest;
use App\Models\ActivityTime;
use App\Models\UnitUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use URL;

class ActivityTimes extends Controller {
  public function index(Request $request) {
    $activity_times = ActivityTime::fetch();
    $links = '';
    $sort = $request->input('sort', '###');

    if ($request->has('unit_id')) {
      $unit_id = $request->unit_id;
      $activity_times = $activity_times->whereHas('unit_user', function ($query) use ($unit_id) {
        return $query->where('unit_id', $unit_id);
      });
    }
    if ($request->has('day_of_week')) {
      $activity_times = $activity_times->where('day_of_week', $request->day_of_week);
    }

    if ($request->has('sort')) {
      $activity_times = $activity_times->orderBy($request->input('sort'), 'desc');
    }

    $activity_times = $activity_times->paginate(10);
    return view('panel.activity_times.index', [
      'activity_times' => $activity_times,
      'links' => $links,
      'sort' => $sort,
      'search' => isset(parse_url(url()->full())['query']) ? parse_url(url()->full())['query'] : '',
      'filters' => [
        'unit_id' => $request->input('unit_id', ''),
        'day_of_week' => $request->input('day_of_week', ''),
      ],
    ]);
  }
  public function show(Request $request, ActivityTime $activity_time) {
    return view('panel.activity_times.show', ['activity_time' => $activity_time]);
  }
  public function create(Request $request) {
    $unit_users = UnitUser::where('permission', UnitUser::MEMBER)->where('status', UnitUser::ACCEPTED);
    if (Auth::user()->isAdmin()) {
      $unit_users = $unit_users->get();
    } else if (Auth::user()->isManager()) {
      $unit_users = $unit_users->whereHas('unit', function ($query) {
        return $query->whereHas('managers', function ($query) {
          return $query->where('users.id', Auth::user()->id);
        });
      })->get();
    } else if (Auth::user()->isSecretary()) {
      $unit_users = $unit_users->whereHas('unit', function ($query) {
        return $query->whereHas('secretaries', function ($query) {
          return $query->where('users.id', Auth::user()->id);
        });
      })->get();
    } else {
      $unit_users = $unit_users->where('user_id', Auth::user()->id)->get();
    }

    return view('panel.activity_times.create.default', [
      'unit_users' => $unit_users,
    ]);
  }
  public function createVisit(Request $request) {
    $unit_users = UnitUser::where('permission', UnitUser::MEMBER)->where('status', UnitUser::ACCEPTED);
    if (Auth::user()->isAdmin()) {
      $unit_users = $unit_users->get();
    } else if (Auth::user()->isManager()) {
      $unit_users = $unit_users->whereHas('unit', function ($query) {
        return $query->whereHas('managers', function ($query) {
          return $query->where('users.id', Auth::user()->id);
        });
      })->get();
    } else if (Auth::user()->isSecretary()) {
      $unit_users = $unit_users->whereHas('unit', function ($query) {
        return $query->whereHas('secretaries', function ($query) {
          return $query->where('users.id', Auth::user()->id);
        });
      })->get();
    } else {
      $unit_users = $unit_users->where('user_id', Auth::user()->id)->get();
    }

    return view('panel.activity_times.create.visit', [
      'unit_users' => $unit_users,
    ]);
  }
  public function store(ActivityTimeCreateRequest $request) {
    $inputs = $request->all();
    $inputs['start_time'] = $request->start_timehour * 3600 + $request->start_timeminute * 60;
    $inputs['finish_time'] = $request->finish_timehour * 3600 + $request->finish_timeminute * 60;
    $activity_time = ActivityTime::create($inputs);
    return redirect()->route('panel.activity-times.show', ['activity_time' => $activity_time]);
  }
  public function edit(ActivityTime $activity_time) {
    $unit_users = UnitUser::where('permission', UnitUser::MEMBER)->where('status', UnitUser::ACCEPTED);
    if (Auth::user()->isAdmin()) {
      $unit_users = $unit_users->get();
    } else if (Auth::user()->isManager()) {
      $unit_users = $unit_users->whereHas('unit', function ($query) {
        return $query->whereHas('managers', function ($query) {
          return $query->where('users.id', Auth::user()->id);
        });
      })->get();
    } else if (Auth::user()->isSecretary()) {
      $unit_users = $unit_users->whereHas('unit', function ($query) {
        return $query->whereHas('secretaries', function ($query) {
          return $query->where('users.id', Auth::user()->id);
        });
      })->get();
    } else {
      $unit_users = $unit_users->where('user_id', Auth::user()->id)->get();
    }

    switch ($activity_time->type) {
    case ActivityTime::VISIT:
      return view('panel.activity_times.edit.visit', [
        'activity_time' => $activity_time,
        'unit_users' => $unit_users,
      ]);
    }
    return view('panel.activity_times.edit.default', [
      'activity_time' => $activity_time,
      'unit_users' => $unit_users,
    ]);
  }
  public function update(ActivityTimeEditRequest $request, ActivityTime $activity_time) {
    $inputs = $request->all();
    $inputs['start_time'] = $request->start_timehour * 3600 + $request->start_timeminute * 60;
    $inputs['finish_time'] = $request->finish_timehour * 3600 + $request->finish_timeminute * 60;
    $activity_time->fill($inputs)->save();
    return redirect()->route('panel.activity-times.show', ['activity_time' => $activity_time])->with(['edit_success' => true]);
  }
  public function destroy(ActivityTime $activity_time) {
    $activity_time->delete();
    if (URL::route('panel.activity-times.show', ['activity_time' => $activity_time]) == URL::previous()) {
      return redirect()->route('panel.activity-times.index');
    } else {
      return redirect()->back();
    }

  }
}
