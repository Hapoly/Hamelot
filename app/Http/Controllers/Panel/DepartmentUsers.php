<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Department;
use App\User;
use App\Models\DepartmentUser;
use URL;

class DepartmentUsers extends Controller{
  public function index(Request $request){
    $department_users = DepartmentUser::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $department_users = $department_users->orderBy($request->input('sort'), 'desc');
      $department_users = $department_users->paginate(10);
      $links = $department_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $department_users = $department_users->whereHas('user', function($query){
        return $query->whereRaw("first_name + ' ' + last_name LIKE '%$search%'");
      });
      $department_users = $department_users->paginate(10);
      $links = $department_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $department_users = $department_users->whereHas('user', function($query){
        return $query->whereRaw("first_name + ' ' + last_name LIKE '%$search%'");
      });
      $department_users = $department_users->orderBy($request->input('sort'), 'desc');
      $department_users = $department_users->paginate(10);
      $links = $department_users->appends(['sort' => $request->input('sort')])->links();
    }else{
      $department_users = $department_users->paginate(10);
    }
    return view('panel.department_users.index', [
      'department_users'   => $department_users,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }

  public function send(Request $request, User $user, Department $department){
    DepartmentUser::create([
      'user_id'       => $user->id,
      'department_id' => $department->id,
      'status'        => DepartmentUser::PENDING,
    ]);
    return redirect()->back();
  }
}
