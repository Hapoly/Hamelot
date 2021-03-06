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

use App\Http\Requests\Users\Create\Admin as AdminCreateRequest;
use App\Http\Requests\Users\Edit\Admin as AdminEditRequest;

use App\Http\Requests\Users\Create\Manager as ManagerCreateRequest;
use App\Http\Requests\Users\Edit\Manager as ManagerEditRequest;

use App\Http\Requests\Users\Create\Secretary as SecretaryCreateRequest;
use App\Http\Requests\Users\Edit\Secretary as SecretaryEditRequest;

use App\Http\Requests\Users\Create\Doctor as DoctorCreateRequest;
use App\Http\Requests\Users\Edit\Doctor as DoctorEditRequest;

use App\Http\Requests\Users\Create\Nurse as NurseCreateRequest;
use App\Http\Requests\Users\Edit\Nurse as NurseEditRequest;

use App\Http\Requests\Users\Create\Patient as PatientCreateRequest;
use App\Http\Requests\Users\Edit\Patient as PatientEditRequest;
class Users extends Controller{
  /**
   * listing the users
   */
  public function index(Request $request){
    $users = User::fetch();
    
    $sort = $request->input('sort', '###');

    if($request->has('group_code') && $request->group_code != 0)
      $users = $user->where('group_code', $request->group_code);

    if($request->has('first_name') && $request->first_name != '')
      $users = $users->where('first_name', 'LIKE' , '%'.$request->first_name.'%');
    
    if($request->has('last_name')  && $request->last_name != '')
      $users = $users->where('last_name', 'LIKE' , '%'.$request->last_name.'%');
        
    $unit_id = $request->input('unit_id', 0);
    $unit_id = $request->input('unit_id', 0);
    if($unit_id != 0){
      if($unit_id != 0){
        $users = $users->whereHas('units', function($query) use($unit_id){
          return $query->where('units.id', $unit_id);
        });
      }else{
        $users = $users->whereHas('units', function($query) use ($unit_id){
          return $query->where('units.unit_id', $unit_id);
        });
      }
    }
    if($request->gender != 0){
      if($request->group_code == User::G_DOCTOR)
        $users = $users->whereHas('doctor', function($query) use($request){
          return $query->where('gender', $request->gender);
        });
      if($request->group_code == User::G_NURSE)
        $users = $users->whereHas('nurse', function($query) use($request){
          return $query->where('gender', $request->gender);
        });
      if($request->group_code == User::G_PATIENT)
        $users = $users->whereHas('patient', function($query) use($request){
          return $query->where('gender', $request->gender);
        });
    }
    $users = $users->paginate(10);
    $links = $users->appends(['first_name' => $request->first_name])->links();
    return view('panel.users.index', [
      'users'           => $users,
      'links'           => $links,
      'units'           => Unit::fetch(true)->get(),
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'         => [
        'first_name'    => $request->first_name,
        'last_name'     => $request->last_name,
        'group_code'    => $request->group_code,
        'gender'        => $request->gender,
        'doctor_degree' => $request->doctor_degree,
        'doctor_field'  => $request->doctor_field,
        'nurse_degree'  => $request->nurse_degree,
        'nurse_field'   => $request->nurse_field,
        'unit_id'       => $unit_id,
        'unit'          => Unit::find($unit_id),
        'unit_id' => $unit_id,
      ],
    ]);
  }
  public function show(User $user){
    if(!Auth::user()->can('read_info', $user))
      abort(404);
    switch($user->group_code){
      case User::G_ADMIN:
          return view('panel.users.show.admin', ['user' => $user]);
        break;
      case User::G_MANAGER:
          return view('panel.users.show.manager', ['user' => $user]);
        break;
      case User::G_DOCTOR:
          return view('panel.users.show.doctor', ['user' => $user]);
        break;
      case User::G_SECRETARY:
          return view('panel.users.show.secretary', ['user' => $user]);
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
  public function createDoctor(Request $request) {
    return view('panel.users.create.doctor', [
      'unit_id' => $request->input('unit_id', 0),
    ]);
  }
  public function createNurse(Request $request) {
    return view('panel.users.create.nurse', [
      'unit_id' => $request->input('unit_id', 0),
    ]);
  }
  public function createPatient() { return view('panel.users.create.patient');  }
  public function createSecretary(Request $request) {
    return view('panel.users.create.secretary', [
      'unit_id' => $request->input('unit_id', 0),
    ]);
  }
  /**
   * store users in user groups
   */
  public function storeAdmin(AdminCreateRequest $request){
    $inputs = $request->all();
    $inputs['group_code'] = User::G_ADMIN;
    $inputs['slug'] = rand(0, 99999999);
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $user = User::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storeManager(ManagerCreateRequest $request){
    $inputs = $request->all();
    $inputs['group_code'] = User::G_MANAGER;
    $inputs['slug'] = rand(0, 99999999);
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $user = User::create($inputs);
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  
  public function storeSecretary(SecretaryCreateRequest $request){
    $inputs = $request->all();
    $inputs['group_code'] = User::G_SECRETARY;
    $inputs['slug'] = rand(0, 99999999);
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $user = User::create($inputs);
    if($request->has('unit_id')){
      if($request->unit_id != 0){
        UnitUser::create([
          'unit_id'     => $request->unit_id,
          'user_id'     => $user->id,
          'permission'  => UnitUser::SECRETARY,
          'status'      => UnitUser::ACCEPTED,
        ]);
        return redirect()->route('panel.units.show', ['unit_id' => $request->unit_id]);
      }
    }
    if(Auth::user()->can('read_info', $user))
      return redirect()->route('panel.users.show', ['user' => $user]);
    else if($request->has('unit_id'))
      return redirect()->route('panel.units.show', ['unit' => $request->unit_id]);
  }

  public function storeDoctor(DoctorCreateRequest $request){
    $user = new User;
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
      // Storage::disk('public')->delete($user->profile);
    }
    $inputs['group_code'] = User::G_DOCTOR;
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    if(!$request->input('email'))
      unset($inputs['email']);

    $user->fill($inputs);
    $user->save();
    $inputs['user_id'] = $user->id;

    $doctor = new Doctor;
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
    if($request->has('unit_id')){
      if($request->unit_id != 0){
        UnitUser::create([
          'unit_id'     => $request->unit_id,
          'user_id'     => $user->id,
          'permission'  => UnitUser::MEMBER,
          'status'      => UnitUser::ACCEPTED,
        ]);
        return redirect()->route('panel.units.show', ['unit_id' => $request->unit_id]);
      }
    }
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storeNurse(NurseCreateRequest $request){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
    }
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $inputs['group_code'] = User::G_NURSE;
    $user = User::create($inputs);
    $inputs['user_id'] = $user->id;
    $nurse = Nurse::create($inputs);
    if($request->has('unit_id')){
      if($request->unit_id != 0){
        UnitUser::create([
          'unit_id'     => $request->unit_id,
          'user_id'     => $user->id,
          'permission'  => UnitUser::MEMBER,
          'status'      => UnitUser::ACCEPTED,
        ]);
        return redirect()->route('panel.units.show', ['unit_id' => $request->unit_id]);
      }
    }
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function storePatient(PatientCreateRequest $request){
    $inputs = $request->all();
    $inputs['slug'] = rand(0, 99999999);
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
    }
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
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
    if(!(Auth::user()->can('write_info', $user)))
      abort(403);
    switch($user->group_code){
      case User::G_ADMIN:
        return view('panel.users.edit.admin', ['user' => $user]);
        break;
      case User::G_MANAGER:
        return view('panel.users.edit.manager', ['user' => $user]);
        break;
      case User::G_DOCTOR:
        return view('panel.users.edit.doctor', ['user' => $user]);
        break;
      case User::G_SECRETARY:
        return view('panel.users.edit.secretary', ['user' => $user]);
        break;
      case User::G_NURSE:
        return view('panel.users.edit.nurse', ['user' => $user]);
        break;
      case User::G_PATIENT:
        return view('panel.users.edit.patient', ['user' => $user]);
        break;
    }
    abort(404);
  }
  /**
   * update methods
   */
  public function updateAdmin(AdminEditRequest $request, User $user){
    $inputs = $request->all();
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $inputs['group_code'] = User::G_ADMIN;
    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateManager(ManagerEditRequest $request, User $user){
    $inputs = $request->all();
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $inputs['group_code'] = User::G_MANAGER;
    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateSecretary(SecretaryEditRequest $request, User $user){
    $inputs = $request->all();
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $inputs['group_code'] = User::G_SECRETARY;
    $user->fill($inputs)->save();
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateDoctor(DoctorEditRequest $request, User $user){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
      Storage::disk('public')->delete($user->profile);
    }
    $inputs['group_code'] = User::G_DOCTOR;
    if($inputs['email'] == null)
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }

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
    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updateNurse(NurseEditRequest $request, User $user){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
    }
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $inputs['group_code'] = User::G_NURSE;

    $user->fill($inputs);
    $user->save();

    $nurse = $user->nurse;
    $nurse->fill($inputs);
    $nurse->save();

    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function updatePatient(PatientEditRequest $request, User $user){
    $inputs = $request->all();
    if($request->hasFile('profile')){
      $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
    }
    if(!$request->input('email'))
      unset($inputs['email']);
    if(!Auth::user()->isAdmin()){
      unset($inputs['status']);
      unset($inputs['public']);
    }
    $inputs['group_code'] = User::G_PATIENT;

    $user->fill($inputs);
    $user->save();

    $patient = $user->patient;
    $patient->fill($inputs);
    $patient->save();

    return redirect()->route('panel.users.show', ['user' => $user]);
  }
  public function destroy(User $user){
    if(!(Auth::user()->isAdmin() || $user->id == Auth::user()->id))
      abort(403);
    $user->delete();
    if(URL::route('panel.users.show', ['user' => $user]) == URL::previous())
      return redirect()->route('panel.users.index');
    else
      return redirect()->back();
  }
}
