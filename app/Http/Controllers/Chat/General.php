<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use URL;

class General extends Controller {
  public function info(Request $request){
    return Auth::user();
  }

  // public function newMessage(Request $request){
  //   broadcast(new \App\Events\NewMessage($request->name, $request->message));
  // }
}
