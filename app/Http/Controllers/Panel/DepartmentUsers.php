<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Department;
use App\User;
use App\Models\DepartmentUser;
use URL;

class DepartmentUsers extends Controller{
  public function send(Request $request, User $user, Department $department){
    DepartmentUser::create([
      'user_id'       => $user->id,
      'department_id' => $department->id,
      'status'        => DepartmentUser::PENDING,
    ]);
    return redirect()->back();
  }
}
