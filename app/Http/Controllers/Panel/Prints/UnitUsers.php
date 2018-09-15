<?php

namespace App\Http\Controllers\Panel\Prints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\UnitUser;
use App\User;

class UnitUsers extends Controller{
  public function index(Request $request){
    $unit_users = UnitUser::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->has('status') && $request->status != 0)
      $unit_users = $unit_users->where('status', $request->status);
    if($request->has('unit_id') && $request->unit_id != 0)
      $unit_users = $unit_users->where('unit_id', $request->unit_id);
    if($request->has('user_id')){
      $user = User::getByName($request->user_id);
      if($user){
        $unit_users = $unit_users->where('user_id', $user->id);
      }
    }
    if($request->has('page')){
      if($request->page != 0)
        $unit_users = $unit_users->paginate(10);  
      else
        $unit_users = $unit_users->get();
    }else
      $unit_users = $unit_users->paginate(10);
    return view('panel.prints.unit_users.index', [
      'unit_users'  => $unit_users,
    ]);
  }
}
