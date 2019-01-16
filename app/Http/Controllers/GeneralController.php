<?php

namespace App\Http\Controllers;

use App\Drivers\Time;
use App\Models\Unit;
use App\User;
use Illuminate\Http\Request;

class GeneralController extends Controller {
  public function showUser(Request $request, $slug) {
    $user = User::where('slug', $slug)->firstOrFail();
    $activity_times = $user->activity_times($request->input('time', 0));
    $user->activity_times = $activity_times;
    return view('general.show.user', [
      'user' => $user,
      'offset' => $request->input('time', time()),
    ]);
  }
  public function showUnit(Request $request, $slug) {
    $unit = Unit::where('slug', $slug)->firstOrFail();
    $activity_times = $unit->activity_times($request->input('time', 0));
    $unit->activity_times = $activity_times;
    return view('general.show.unit.' . $unit->group_code, [
      'unit' => $unit,
      'offset' => $request->input('time', time()),
    ]);
  }

  public function sessionAll(Request $request) {
    return $request->session()->all();
  }

  public function indexFields(Request $request){
    return view('fields.index');
  }
  public function resultFields(Request $request){
    return view('fields.result');
  }
}
