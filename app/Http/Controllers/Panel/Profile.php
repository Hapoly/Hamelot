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
use App\Models\Permission;
use App\Models\UnitUser;
use App\Models\Unit;

use App\Http\Requests\Profile\Edit\Admin as AdminEditRequest;
use App\Http\Requests\Profile\Edit\Manager as ManagerEditRequest;
use App\Http\Requests\Profile\Edit\Doctor as DoctorEditRequest;
use App\Http\Requests\Profile\Edit\Nurse as NurseEditRequest;
use App\Http\Requests\Profile\Edit\Patient as PatientEditRequest;

class Profile extends Controller{
  /**
   * edit users
   */
  public function edit(Request $request){
    $user = Auth::user();
    switch($user->group_code){
      case User::G_ADMIN:
        return view('panel.profile.admin', ['user' => $user]);
        break;
      case User::G_MANAGER:
        return view('panel.profile.manager', ['user' => $user]);
        break;
      case User::G_DOCTOR:
        return view('panel.profile.doctor', ['user' => $user, 'degrees' => ConstValue::doctor_degrees()->get(), 'fields' => ConstValue::doctor_fields()->get(), 'genders' => ConstValue::genders()->get()]);
        break;
      case User::G_NURSE:
        return view('panel.profile.nurse', ['user' => $user, 'degrees' => ConstValue::nurse_degrees()->get(), 'fields' => ConstValue::nurse_fields()->get(), 'genders' => ConstValue::genders()->get()]);
        break;
      case User::G_PATIENT:
        return view('panel.profile.patient', ['user' => $user, 'genders' => ConstValue::genders()->get()]);
        break;
    }
    abort(404);
  }
  /**
   * update methods
   */
  public function updateAdmin(AdminEditRequest $request){
    $inputs = $request->all();
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_ADMIN;
    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateManager(ManagerEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    if(isset($inputs['password'])){
      $inputs['password'] = bcrypt($inputs['password']);
    }else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_MANAGER;
    $user->fill($inputs)->save();
    if(isset($inputs['password']))
      Auth::attempt([
        'username'  => $user->username,
        'password'  => $inputs['password'],
      ]);
    return redirect()->route('panel.profile');
  }
  public function updateDoctor(DoctorEditRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
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
  public function updateNurse(NurseEditRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
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
  public function updatePatient(PatientEditRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
    }
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);
    $inputs['group_code'] = User::G_PATIENT;

    $user->fill($inputs);
    $user->save();

    $patient = $user->patient;
    $patient->fill($inputs);
    $patient->save();

    return redirect()->route('panel.users.show', ['user' => $user]);
  }
}
