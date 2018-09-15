<?php

namespace App\Http\Controllers\Panel\Prints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Permission;
use App\User;

class Permissions extends Controller{
  public function index(Request $request){
    $permissions = Permission::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->has('status') && $request->status != 0)
      $permissions = $permissions->where('status', $request->status);
    
    if($request->has('patient_id')){
      $user = User::getByName($request->patient_id);
      if($user){
        $permissions = $permissions->where('patient_id', $user->id);
      }
    }
    if($request->has('requester_id')){
      $user = User::getByName($request->requester_id);
      if($user){
        $permissions = $permissions->where('requester_id', $user->id);
      }
    }
    if($request->has('page')){
      if($request->page != 0)
        $permissions = $permissions->paginate(10);  
      else
        $permissions = $permissions->get();
    }else
      $permissions = $permissions->paginate(10);
    return view('panel.prints.permissions.index', [
      'permissions'  => $permissions,
    ]);
  }
}
