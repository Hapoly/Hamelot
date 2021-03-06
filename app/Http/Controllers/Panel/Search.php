<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ConstValue;
use App\Models\Unit;
use App\Models\FieldTemplate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Search extends Controller {
  public function patients(Request $request) {
    $users = null;
    if (Auth::user()->isAdmin()) {
      $users = User::where('group_code', User::G_PATIENT);
    } else {
      $users = Auth::user()->patients();
    }

    $users = $users->whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->select(['first_name', 'last_name', 'users.id'])
      ->get();
    $results = [];
    foreach ($users as $user) {
      array_push($results, [
        'id' => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name,
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function units(Request $request) {
    $units = null;
    if (Auth::user()->isAdmin()) {
      $units = Unit::whereRaw("title LIKE '%" . $request->input('term') . "%'")->get();
    } else {
      $units = Auth::user()->units()->whereRaw("title LIKE '%" . $request->input('term') . "%'")->get();
    }

    $results = [];
    foreach ($units as $unit) {
      array_push($results, [
        'id' => $unit->id,
        'label' => $unit->complete_title,
        'value' => $unit->complete_title,
      ]);
    }
    return $results;
  }
  public function doctors(Request $request) {
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', User::G_DOCTOR)
      ->select(['first_name', 'last_name', 'id'])
      ->get();
    $results = [];
    foreach ($users as $user) {
      array_push($results, [
        'id' => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name,
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function members(Request $request) {
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', '<>', User::G_PATIENT)
      ->where('group_code', '<>', User::G_ADMIN)
      ->where('group_code', '<>', User::G_MANAGER)
      ->get();
    $results = [];
    foreach ($users as $user) {
      array_push($results, [
        'id' => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function secretaries(Request $request) {
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', User::G_SECRETARY)
      ->get();
    $results = [];
    foreach ($users as $user) {
      array_push($results, [
        'id' => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function joiners(Request $request) {
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', '<>', User::G_PATIENT)
      ->where('group_code', '<>', User::G_ADMIN)
      ->get();
    $results = [];
    foreach ($users as $user) {
      array_push($results, [
        'id' => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function managers(Request $request) {
    $users = User::
      whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $request->input('term') . "%'")
      ->where('group_code', User::G_MANAGER)
      ->get();
    $results = [];
    foreach ($users as $user) {
      array_push($results, [
        'id' => $user->id,
        'label' => $user->first_name . ' ' . $user->last_name . ' (' . $user->group_str . ')',
        'value' => $user->first_name . ' ' . $user->last_name,
      ]);
    }
    return $results;
  }
  public function unitUsers(Request $request) {
    $units = Unit::
      whereRaw('title LIKE "%' . $request->input('term') . '%"')
      ->get();
    $results = [];
    foreach ($units as $unit) {
      array_push($results, [
        'id' => 'u' . $unit->id,
        'label' => $unit->complete_title,
        'value' => $unit->complete_title,
      ]);
      foreach ($unit->members as $user) {
        array_push($results, [
          'id' => 's' . $user->id,
          'label' => $unit->complete_title . ' : ' . $user->full_name,
          'value' => $unit->complete_title . ' : ' . $user->full_name,
        ]);
      }
    }
    return $results;
  }

  public function doctorFields(Request $request) {
    $consts = ConstValue::where('value', 'LIKE', '%' . $request->input('term') . '%')->where('type', ConstValue::DOCTOR_FIELDS)->get();
    $results = [];
    foreach ($consts as $const) {
      array_push($results, [
        'id' => $const->id,
        'label' => $const->value,
        'value' => $const->value,
      ]);
    }
    return $results;
  }

  public function nurseFields(Request $request) {
    $consts = ConstValue::where('value', 'LIKE', '%' . $request->input('term') . '%')->where('type', ConstValue::NURSE_FIELDS)->get();
    $results = [];
    foreach ($consts as $const) {
      array_push($results, [
        'id' => $const->id,
        'label' => $const->value,
        'value' => $const->value,
      ]);
    }
    return $results;
  }

  public function fieldTemplates(Request $request) {
    $fields = FieldTemplate::where('title', 'LIKE', '%' . $request->input('term') . '%')->where('status', FieldTemplate::ACTIVE)->get();
    $results = [];
    foreach ($fields as $field) {
      array_push($results, [
        'id' => $field->id,
        'label' => $field->title . ' ('. $field->type_str .')',
        'value' => $field->title,
      ]);
    }
    return $results;
  }
}
