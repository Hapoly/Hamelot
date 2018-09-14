<?php

namespace App\Http\Controllers\Panel\Prints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;

class Users extends Controller{
  public function users(Request $request){
    $users = User::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->has('first_name'))
      $users = $users->whereRaw("first_name LIKE '%". $request->first_name ."%'");
    if($request->has('last_name'))
      $users = $users->whereRaw("last_name LIKE '%". $request->last_name ."%'");
    if($request->has('group_code'))
      $users = $users->whereRaw("group_code LIKE '%". $request->group_code ."%'");
    if($request->has('sort'))
      $users = $users->orderBy($request->input('sort'), 'desc');
    if($request->has('page')){
      if($request->page != 0)
        $users = $users->paginate(10);  
      else
        $users = $users->get();
    }else
      $users = $users->paginate(10);
    return view('panel.prints.users.index', [
      'users'  => $users,
    ]);
  }
  public function patients(User $user){
    return view('panel.prints.users.patients', [
      'user'  => $user,
    ]);
  }
  public function visitors(User $user){
    return view('panel.prints.users.visitors', [
      'user'  => $user,
    ]);
  }
  public function userInfo(User $user){
    return view('panel.prints.users.info', [
      'user'  => $user,
    ]);
  }
  public function experiments(User $user){
    return view('panel.prints.users.experiments', [
      'user'  => $user,
    ]);
  }
  public function units(User $user){
    return view('panel.prints.users.units', [
      'user'  => $user,
    ]);
  }
}
