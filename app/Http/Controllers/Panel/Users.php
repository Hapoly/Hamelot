<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Drivers\Time;

use URL;
use App\User;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
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
    switch($user->group_code){
      case User::G_ADMIN:
        if(Auth::user()->hasPermissionToUser($user))
          return view('panel.users.show.admin', ['user' => $user]);
        break;
      case User::G_MANAGER:
        return view('panel.users.show.manager', ['user' => $user]);
        break;
      case User::G_DOCTOR:
        return view('panel.users.show.doctor', ['user' => $user]);
        break;
      case User::G_NURSE:
        return view('panel.users.show.nurse', ['user' => $user]);
        break;
      case User::G_PATIENT:
        return view('panel.users.show.patient', ['user' => $user]);
        break;
    }
    abort(404);
  }
  /**
   * create users in user groups
   */
  public function createAdmin()   { return view('panel.users.create.admin');    }
  public function createManager() { return view('panel.users.create.manager');  }
  public function createDoctor()  { return view('panel.users.create.doctor', ['degrees' => ConstValue::doctor_degrees()->get(), 'fields' => ConstValue::doctor_fields()->get(), 'genders' => ConstValue::genders()->get()]);   }
  public function createNurse()  { return view('panel.users.create.nurse', ['degrees' => ConstValue::nurse_degrees()->get(), 'fields' => ConstValue::nurse_fields()->get(), 'genders' => ConstValue::genders()->get()]);   }
  public function createPatient() { return view('panel.users.create.patient', ['genders' => ConstValue::genders()->get()]);  }
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
  public function storePatient(PatientRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::put('public/users', $request->file('profile'));
    }
    $inputs['password'] = bcrypt($inputs['password']);
    $inputs['group_code'] = User::G_PATIENT;
    $inputs['birth_date'] = Time::jmktime(0, 0, 0, $inputs['birth_day'], $inputs['birth_month'], $inputs['birth_year']);
    $user = User::create($inputs);
    $inputs['user_id'] = $user->id;
    $patient = Patient::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  /**
   * edit users
   */
  public function edit(User $user){
    switch($user->group_code){
      case User::G_ADMIN:
        if(Auth::user()->hasPermissionToUser($user))
          return view('panel.users.edit.admin', ['user' => $user]);
        break;
      case User::G_MANAGER:
        if(Auth::user()->hasPermissionToUser($user))
          return view('panel.users.edit.manager', ['user' => $user]);
        break;
      case User::G_DOCTOR:
        if(Auth::user()->hasPermissionToUser($user))
          return view('panel.users.edit.doctor', ['user' => $user, 'degrees' => ConstValue::doctor_degrees()->get(), 'fields' => ConstValue::doctor_fields()->get(), 'genders' => ConstValue::genders()->get()]);
        break;
      case User::G_NURSE:
        if(Auth::user()->hasPermissionToUser($user))
          return view('panel.users.edit.nurse', ['user' => $user, 'degrees' => ConstValue::nurse_degrees()->get(), 'fields' => ConstValue::nurse_fields()->get(), 'genders' => ConstValue::genders()->get()]);
        break;
      case User::G_PATIENT:
        if(Auth::user()->hasPermissionToUser($user))
          return view('panel.users.edit.patient', ['user' => $user, 'genders' => ConstValue::genders()->get()]);
        break;
    }
    abort(404);
  }
  /**
   * update methods
   */
  public function updateAdmin(AdminRequest $request, User $user){
    $inputs = $request->all();
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_ADMIN;
    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateManager(ManagerRequest $request, User $user){
    $inputs = $request->all();
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_MANAGER;
    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateDoctor(DoctorRequest $request, User $user){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::put('public/users', $request->file('profile'));
    }
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_DOCTOR;

    $user->fill($inputs);
    $user->save();

    $doctor = $user->doctor;
    $doctor->fill($inputs);
    $doctor->save();

    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateNurse(NurseRequest $request, User $user){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::put('public/users', $request->file('profile'));
    }
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_NURSE;

    $user->fill($inputs);
    $user->save();

    $nurse = $user->nurse;
    $nurse->fill($inputs);
    $nurse->save();

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
