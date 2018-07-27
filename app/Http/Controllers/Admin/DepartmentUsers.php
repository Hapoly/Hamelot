<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\DepartmentUser;
use App\Models\Department;
use App\User;

use App\Http\Requests\DepartmentUserRequest;

class DepartmentUsers extends Controller{
  public function index(Request $request){
    $department_users = new DepartmentUser;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $department_users = $department_users->orderBy($request->input('sort'), 'desc');
      $department_users = $department_users->paginate(10);
      $links = $department_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $department_users = $department_users->where('department_id', 'LIKE', "%$search%");
      $department_users = $department_users->paginate(10);
      $links = $department_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $department_users = $department_users->where('department_id', 'LIKE', "%$search%");
      $department_users = $department_users->orderBy($request->input('sort'), 'desc');
      $department_users = $department_users->paginate(10);
      $links = $department_users->appends(['sort' => $request->input('sort')])->links();
    }else{
      $department_users = $department_users->paginate(10);
    }
    return view('panel.department_users.index', [
      'department_users'     => $department_users,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(DepartmentUser $department_user){
    return view('panel.department_users.show', ['department_user' => $department_user]);
  }
  public function create(){
    return view('panel.department_users.create', [
      'departments' => Department::where('status', Department::S_ACTIVE)->get(),
      'users'       => User::where('status', User::S_ACTIVE)->get(),
    ]);
  }
  public function store(DepartmentUserRequest $request){
    $department_user = DepartmentUser::create($request->all());
    return redirect()->route('panel.department_users.show', ['department_user' => $department_user]);
  }
  public function edit(DepartmentUser $department_user){
    return view('panel.department_users.edit', [
      'department_user'   => $department_user,
      'departments'       => Department::where('status', Department::S_ACTIVE)->get(),
      'users'           => User::where('status', User::S_ACTIVE)->get(),
    ]);
  }
  public function update(DepartmentUserRequest $request, DepartmentUser $department_user){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/department_users', $request->file('image'));
    $department_user->fill($inputs)->save();
    return redirect()->route('panel.department_users.show', ['department_user' => $department_user]);
  }
  public function destroy(DepartmentUser $department_user){
    $department_user->delete();
    if(URL::route('panel.department_users.show', ['department_user' => $department_user]) == URL::previous())
      return redirect()->route('panel.department_users.index');
    else
      return redirect()->back();
  }
}
