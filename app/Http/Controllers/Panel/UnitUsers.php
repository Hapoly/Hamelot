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
    $unit_users = UnitUser::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $unit_users = $unit_users->orderBy($request->input('sort'), 'desc');
      $unit_users = $unit_users->paginate(10);
      $links = $unit_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $unit_users = $unit_users->whereHas('user', function($query){
        return $query->whereRaw("first_name + ' ' + last_name LIKE '%$search%'");
      });
      $unit_users = $unit_users->paginate(10);
      $links = $unit_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $unit_users = $unit_users->whereHas('user', function($query){
        return $query->whereRaw("first_name + ' ' + last_name LIKE '%$search%'");
      });
      $unit_users = $unit_users->orderBy($request->input('sort'), 'desc');
      $unit_users = $unit_users->paginate(10);
      $links = $unit_users->appends(['sort' => $request->input('sort')])->links();
    }else{
      $unit_users = $unit_users->paginate(10);
    }
    return view('panel.unit_users.index', [
      'unit_users'   => $unit_users,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }

  public function sendDepartment(Request $request, User $user, Department $department){
    UnitUser::create([
      'user_id'       => $user->id,
      'unit_id' => $department->id,
      'status'        => UnitUser::PENDING,
      'type'          => UnitUser::DEPARTMENT,
    ]);
    return redirect()->back();
  }

  public function createPoloclinicManager(Request $request){
    return view('panel.unit_users.policlinic.manager.create',[
      'policlinics' => Policlinic::fetch(true)->get(),
    ]);
  }

  public function createPoloclinicMember(Request $request){
    return view('panel.unit_users.policlinic.member.create',[
      'policlinics' => Policlinic::fetch(true)->get(),
    ]);
  }

  public function createHospitalManager(Request $request){
    return view('panel.unit_users.hospial.manager.create', [
      'hospitals' => Hospital::fetch(true)->get(),
    ]);
  }

  public function createDepartmentMember(Request $request){
    return view('panel.unit_users.department.member.create', [
      'departments' => Department::fetch(true)->get(),
    ])
  }

  public function store(UnitUserManageRequest $request){
    $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
    if(!$user)
      return redirect()->route('panel.unit_users.index');
    $inputs['doctor_id'] = $user->id;
    switch($request->type){
      case 1: // policlinic manager
        $unit_user = UnitUser::where('unit_id', $request->unit_id)
                              ->where('user_id', $user->id)
                              ->where('type', UnitUser::POLICLINIC)
                              ->where('permission', UnitUser::MANAGER)
                              ->first();
        if($unit_user){
          if(!$unit_user->status == UnitUser::ACCEPTED){
            $unit_user->status = UnitUser::PENDING;
            $unit_user->save();
          }
        }else{
          UnitUser::create([
            'unit_id' => $request->unit_id,
            'user_id'       => $user->id,
            'type'          => UnitUser::POLICLINIC,
            'permission'    => UnitUser::MANAGER,
            'status'        => UnitUser::ACCEPTED,
          ]);
        }
        return redirect()->route('panel.policlinics.show', ['policlinic' => $request->unit_id]);
      case 2: // policlinic member
        $unit_user = UnitUser::where('unit_id', $request->unit_id)
                              ->where('user_id', $user->id)
                              ->where('type', UnitUser::POLICLINIC)
                              ->where('permission', UnitUser::MEMBER)
                              ->first();
        if($unit_user){
          if(!$unit_user->status == UnitUser::ACCEPTED){
            $unit_user->status = UnitUser::PENDING;
            $unit_user->save();
          }
        }else{
          UnitUser::create([
            'unit_id' => $request->unit_id,
            'user_id'       => $user->id,
            'type'          => UnitUser::POLICLINIC,
            'permission'    => UnitUser::MEMBER,
            'status'        => UnitUser::ACCEPTED,
          ]);
        }
        return redirect()->route('panel.policlinics.show', ['policlinic' => $request->unit_id]);
      case 3: // hospital manager
        $unit_user = UnitUser::where('unit_id', $request->unit_id)
                              ->where('user_id', $user->id)
                              ->where('type', UnitUser::HOSPITAL)
                              ->where('permission', UnitUser::MANAGER)
                              ->first();
        if($unit_user){
          if(!$unit_user->status == UnitUser::ACCEPTED){
            $unit_user->status = UnitUser::PENDING;
            $unit_user->save();
          }
        }else{
          UnitUser::create([
            'unit_id' => $request->unit_id,
            'user_id'       => $user->id,
            'type'          => UnitUser::HOSPITAL,
            'permission'    => UnitUser::MANAGER,
            'status'        => UnitUser::ACCEPTED,
          ]);
        }
        return redirect()->route('panel.hospitals.show', ['hospital' => $request->unit_id]);
      case 4: // department member
        $unit_user = UnitUser::where('unit_id', $request->unit_id)
                              ->where('user_id', $user->id)
                              ->where('type', UnitUser::DEPARTMENT)
                              ->where('permission', UnitUser::MEMBER)
                              ->first();
        if($unit_user){
          if(!$unit_user->status == UnitUser::ACCEPTED){
            $unit_user->status = UnitUser::PENDING;
            $unit_user->save();
          }
        }else{
          UnitUser::create([
            'unit_id' => $request->unit_id,
            'user_id'       => $user->id,
            'type'          => UnitUser::DEPARTMENT,
            'permission'    => UnitUser::MEMBER,
            'status'        => UnitUser::ACCEPTED,
          ]);
        }
        return redirect()->route('panel.departments.show', ['departments' => $request->unit_id]);
    }
    return $request->all();
  }
}