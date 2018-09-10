<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unit;
use App\User;
use App\Models\UnitUser;
use App\Http\Requests\UnitUserRequest;
use URL;

class UnitUsers extends Controller{
  public function index(Request $request){
    $unit_users = UnitUser::fetch($request->type, $request->permission);
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

  public function createManager(Request $request){
    return view('panel.unit_users.create.manager', [
      'units'   => Unit::fetch(true)->get(),
      'unit_id' => $request->input('unit_id', 0),
    ]);
  }
  public function createMember(Request $request){
    return view('panel.unit_users.create.member', [
      'units'   => Unit::fetch(true)->get(),
      'unit_id' => $request->input('unit_id', 0),
    ]);
  }

  public function store(UnitUserRequest $request){
    $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
    if(!$user)
      return redirect()->route('panel.unit_users.index');
    UnitUser::create([
      'unit_id'     => $request->unit_id,
      'user_id'     => $user->id,
      'permission'  => $request->permission,
      'status'      => UnitUser::ACCEPTED,
    ]);
    return redirect()->route('panel.units.show', ['unit' => $request->unit_id]);
  }
  public function inlineUpdate(Request $request, UnitUser $unit_user){
    if($request->has('action')){
        switch($request->action){
            case 'accept':
                if($unit_user->canAccept()){
                    $unit_user->status = UnitUser::ACCEPTED;
                    $unit_user->save();
                }
                break;
            case 'refuse':
                if($unit_user->canRefuse()){
                    $unit_user->status = UnitUser::REFUSED;
                    $unit_user->save();
                }
                break;
            case 'cancel':
                if($unit_user->canCancel()){
                    $unit_user->status = UnitUser::CANCELED;
                    $unit_user->save();
                }
                break;
        }
        return redirect()->route('panel.unit_$unit_users.show', ['unit_$unit_user' => $unit_user]);
    }else
        abort(404);
}
}