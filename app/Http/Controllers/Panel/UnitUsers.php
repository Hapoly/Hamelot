<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Department;
use App\Models\Policlinic;
use App\User;
use App\Models\UnitUser;
use App\Http\Requests\UnitUserManageRequest;
use URL;

class UnitUsers extends Controller{
  public function index(Request $request){
    $department_users = UnitUser::fetch();
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

  public function sendDepartment(Request $request, User $user, Department $department){
    UnitUser::create([
      'user_id'       => $user->id,
      'department_id' => $department->id,
      'status'        => UnitUser::PENDING,
      'type'          => UnitUser::DEPARTMENT,
    ]);
    return redirect()->back();
  }

  public function createPoloclinicManager(Request $request){
    return view('panel.department_users.policlinic.manager.create',[
      'policlinics' => Policlinic::fetch(true)->get(),
    ]);
  }
  public function store(UnitUserManageRequest $request){
    $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
    if(!$user)
      return redirect()->route('panel.department_users.index');
    $inputs['doctor_id'] = $user->id;
    switch($request->type){
      case 1: // policlinic manager
        UnitUser::create([
          'department_id' => $request->department_id,
          'user_id'       => $user->id,
          'type'          => UnitUser::POLICLINIC,
          'permission'    => UnitUser::MANAGER,
          'status'        => UnitUser::ACCEPTED,
        ]);
        return redirect()->route('panel.policlinics.show', ['policlinic' => $request->department_id]);
    }
    return $request->all();
  }
}
