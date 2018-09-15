<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\User;

class Search extends Controller{
  public function patients(Request $request){
    $users = null;
    if(Auth::user()->isAdmin())
      $users = User::where('group_code', User::G_PATIENT);
    else
      $users = Auth::user()->patients();

    $users = $users->whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->select(['first_name', 'last_name', 'users.id'])
      ->get();
    $results = [];
    foreach($users as $user){
      array_push($results, [
        'id'    => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name,
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function units(Request $request){
    $units = Auth::user()->units()->whereRaw("title LIKE '%". $request->input('term') ."%'")
                          ->get();
    $results = [];
    foreach($units as $unit){
      array_push($results, [
        'id'    => $unit->id,
        'label' => $unit->complete_title,
        'value' => $unit->complete_title,
      ]);
    }
    return $results;
  }
  public function doctors(Request $request){
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', User::G_DOCTOR)
      ->select(['first_name', 'last_name', 'id'])
      ->get();
    $results = [];
    foreach($users as $user){
      array_push($results, [
        'id'    => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name,
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function members(Request $request){
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', '<>', User::G_PATIENT)
      ->where('group_code', '<>', User::G_ADMIN)
      ->where('group_code', '<>', User::G_MANAGER)
      ->get();
    $results = [];
    foreach($users as $user){
      array_push($results, [
        'id'    => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function joiners(Request $request){
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', '<>', User::G_PATIENT)
      ->where('group_code', '<>', User::G_ADMIN)
      ->get();
    $results = [];
    foreach($users as $user){
      array_push($results, [
        'id'    => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function managers(Request $request){
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', User::G_MANAGER)
      ->get();
    $results = [];
    foreach($users as $user){
      array_push($results, [
        'id'    => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
}
