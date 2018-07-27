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
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\ConstValue;

use App\Http\Requests\UserRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\ManagerRequest;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\NurseRequest;
use App\Http\Requests\PatientRequest;

class Users extends Controller{
  public function index(Request $request){
    $users = new User;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $users = $users->orderBy($request->input('sort'), 'desc');
      $users = $users->paginate(10);
      $links = $users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $users = $users->where('username', 'LIKE', "%$search%");
      $users = $users->paginate(10);
      $links = $users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $users = $users->where('username', 'LIKE', "%$search%");
      $users = $users->orderBy($request->input('sort'), 'desc');
      $users = $users->paginate(10);
      $links = $users->appends(['sort' => $request->input('sort')])->links();
    }else{
      $users = $users->paginate(10);
    }
    return view('panel.users.index', [
      'users'       => $users,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(User $user){
    return view('panel.users.show', ['user' => $user]);
  }
  /**
   * create users in user groups
   */
  public function createAdmin()   { return view('panel.users.create.admin');    }
  public function createManager() { return view('panel.users.create.manager');  }
  public function createDoctor()  { return view('panel.users.create.doctor', ['degrees' => ConstValue::doctor_degrees()->get(), 'fields' => ConstValue::doctor_fields()->get(), 'genders' => ConstValue::genders()->get()]);   }
  public function createNurse()  { return view('panel.users.create.nurse', ['degrees' => ConstValue::nurse_degrees()->get(), 'fields' => ConstValue::nurse_fields()->get(), 'genders' => ConstValue::genders()->get()]);   }
  public function createPatient() { return view('panel.users.create.patient');  }
  /**
   * store users in user groups
   */
  public function storeAdmin(AdminRequest $request){
    $inputs = $request->all();
    $inputs['password'] = bcrypt($inputs['password']);
    $inputs['group_code'] = User::G_ADMIN;
    $user = User::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storeManager(ManagerRequest $request){
    $inputs = $request->all();
    $inputs['password'] = bcrypt($inputs['password']);
    $inputs['group_code'] = User::G_MANAGER;
    $user = User::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storeDoctor(DoctorRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::put('public/users', $request->file('profile'));
    }
    $inputs['password'] = bcrypt($inputs['password']);
    $inputs['group_code'] = User::G_DOCTOR;
    $user = User::create($inputs);
    $inputs['user_id'] = $user->id;
    $doctor = Doctor::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storeNurse(NurseRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::put('public/users', $request->file('profile'));
    }
    $inputs['password'] = bcrypt($inputs['password']);
    $inputs['group_code'] = User::G_NURSE;
    $user = User::create($inputs);
    $inputs['user_id'] = $user->id;
    $nurse = Nurse::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storePatient(NurseRequest $request){
    $inputs = $request->all();
    $inputs['password'] = bcrypt($inputs['password']);
    $inputs['group_code'] = User::G_ADMIN;
    $user = User::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function edit(User $user){
    return view('panel.users.edit', ['user' => $user]);
  }
  public function update(UserRequest $request, User $user){
    $inputs = $request->all();
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);

    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function destroy(User $user){
    $user->delete();
    if(URL::route('panel.users.show', ['user' => $user]) == URL::previous())
      return redirect()->route('panel.users.index');
    else
      return redirect()->back();
  }
}
