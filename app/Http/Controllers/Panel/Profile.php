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
use App\Models\UserConst;

use App\Http\Requests\Profile\Edit\Admin as AdminEditRequest;
use App\Http\Requests\Profile\Edit\Manager as ManagerEditRequest;
use App\Http\Requests\Profile\Edit\Doctor as DoctorEditRequest;
use App\Http\Requests\Profile\Edit\Nurse as NurseEditRequest;
use App\Http\Requests\Profile\Edit\Patient as PatientEditRequest;
use App\Http\Requests\Profile\Edit\Secretary as SecretaryEditRequest;

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
        return view('panel.profile.doctor', ['user' => $user]);
        break;
      case User::G_NURSE:
        return view('panel.profile.nurse', ['user' => $user]);
        break;
      case User::G_PATIENT:
        return view('panel.profile.patient', ['user' => $user]);
        break;
      case User::G_SECRETARY:
        return view('panel.profile.secretary', ['user' => $user]);
        break;
    }
    abort(404);
  }
  /**
   * update methods
   */
  public function updateAdmin(AdminEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    $inputs['group_code'] = User::G_ADMIN;
    if($inputs['email'] == null)
      unset($inputs['email']);
    $user->fill($inputs)->save();
    return redirect()->route('panel.profile');
  }
  public function updateManager(ManagerEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    if($inputs['email'] == null)
      unset($inputs['email']);
    $inputs['group_code'] = User::G_MANAGER;
    $user->fill($inputs)->save();
    return redirect()->route('panel.profile');
  }
  public function updateSecretary(SecretaryEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    if($inputs['email'] == null)
      unset($inputs['email']);
    $inputs['group_code'] = User::G_SECREATRY;
    $user->fill($inputs)->save();
    return redirect()->route('panel.profile');
  }
  public function updateDoctor(DoctorEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
      Storage::disk('public')->delete($user->profile);
    }
    $inputs['group_code'] = User::G_DOCTOR;
    unset($inputs['status']);
    unset($inputs['public']);
    if($inputs['email'] == null)
      unset($inputs['email']);

    $user->fill($inputs);
    $user->save();

    $doctor = $user->doctor;
    $doctor->fill($inputs);
    $doctor->save();
    $field_names = explode(', ', $request->fields);
    // return $field_names;
    UserConst::where('user_id', $user->id)->delete();
    foreach($field_names as $field_name){
      $const = ConstValue::where('value', str_replace(',', '', $field_name))->first();
      if(!$const)
        continue;
      
      UserConst::create([
        'user_id'   => $user->id,
        'const_id'  => $const->id,
      ]);
    }
    return redirect()->route('panel.profile');
  }
  public function updateNurse(NurseEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
      Storage::disk('public')->delete($user->profile);
    }
    $inputs['group_code'] = User::G_NURSE;
    if($inputs['email'] == null)
      unset($inputs['email']);
    $user->fill($inputs);
    $user->save();

    $nurse = $user->nurse;
    $nurse->fill($inputs);
    $nurse->save();
    return redirect()->route('panel.profile');
  }
  public function updatePatient(PatientEditRequest $request){
    $user = Auth::user();
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
      Storage::disk('public')->delete($user->profile);
    }
    $inputs['group_code'] = User::G_PATIENT;
    $inputs['birth_date'] = Time::jmktime(0, 0, 0, intval($inputs['birth_day']), intval($inputs['birth_month']), intval($inputs['birth_year']));
    if($inputs['email'] == null)
      unset($inputs['email']);
    $user->fill($inputs);
    $user->save();

    $patient = $user->patient;
    $patient->fill($inputs);
    $patient->save();
    return redirect()->route('panel.profile');
  }
}
