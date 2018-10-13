<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drivers\Time;
use App\User;

class GeneralController extends Controller
{
    public function showUser(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        $activity_times = $user->activity_times($request->input('time', 0));
        $user->activity_times = $activity_times;
        return view('general.show.user', [
            'user'      => $user,
            'offset'    => $request->input('time', time()),
        ]);
    }
}
