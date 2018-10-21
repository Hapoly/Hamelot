<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unit;
use App\User;
use App\Models\UnitUser;
use App\Http\Requests\UnitUserRequest;
use URL;
use Auth;

class UnitUsers extends Controller{
  public function index(Request $request){
    $unit_users = UnitUser::fetch($request->type, $request->permission);
    $links = '';
    $sort = $request->input('sort', '###');
    if($request->has('status') && $request->status != "0")
      $unit_users = $unit_users->where('status', $request->status);
    if($request->has('unit_id') && $request->unit_id != "0"){
      $unit_users = $unit_users->where('unit_id', $request->unit_id);
    }
    if($request->has('user_id')){
      $user = User::getByName($request->user_id);
      if($user){
        $unit_users = $unit_users->where('user_id', $user->id);
      }
    }
    if($request->has('sort'))
      $unit_users = $unit_users->orderBy($request->input('sort'), 'desc');
    $unit_users = $unit_users->paginate(10);
    return view('panel.unit_users.index', [
      'unit_users'  => $unit_users,
      'units'       => Unit::fetch(true)->get(),
      'links'       => $links,
      'sort'        => $sort,
      'search'          => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'         => [
        'unit_id'           => $request->input('unit_id', "0"),
        'user_id'           => $request->input('user_id', "0"),
        'status'            => $request->input('status',  "0"),
      ],
    ]);
  }

  public function sendUnit(Request $request, User $user, Unit $unit){
    UnitUser::create([
      'user_id'       => $user->id,
      'unit_id'       => $unit->id,
      'status'        => UnitUser::PENDING,
      'type'          => UnitUser::DEPARTMENT,
    ]);
    return redirect()->back();
  }

  public function createManager(Request $request){
    $user = User::find($request->input('user_id', ''));
    $full_name = '';
    if($user)
      $full_name = $user->full_name;
    return view('panel.unit_users.create.manager', [
      'units'   => Unit::fetch(true)->get(),
      'unit_id' => $request->input('unit_id', 0),
      'full_name' => $full_name,
    ]);
  }
  public function createMember(Request $request){
    $user = User::find($request->input('user_id', ''));
    $full_name = '';
    if($user)
      $full_name = $user->full_name;
    return view('panel.unit_users.create.member', [
      'units'   => Unit::fetch(true)->get(),
      'unit_id' => $request->input('unit_id', 0),
      'full_name' => $full_name,
    ]);
  }

  public function store(UnitUserRequest $request){
    $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
    if(!$user)
      return redirect()->back()->with('failed', __('unit_users.failed_to_find_user'));
    UnitUser::create([
      'unit_id'     => $request->unit_id,
      'user_id'     => $user->id,
      'permission'  => $request->permission,
      'status'      => UnitUser::ACCEPTED,
    ]);
    return redirect()->route('panel.units.show', ['unit' => $request->unit_id]);
  }
  public function inlineUpdate(Request $request, UnitUser $unit_user, $action){
    switch($action){
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
    return redirect()->back();
  }
  public function send(Request $request, Unit $unit){
    if(!$unit->can_join)
      abort(403);
    $user = Auth::user();
    if($user->isManager()){
      UnitUser::create([
        'unit_id' => $unit->id,
        'user_id' => $user->id,
        'permission'  => UnitUser::MANAGER,
        'status'  => UnitUser::PENDING,
      ]);
      return redirect()->back()->with('success', __('unit_users.success_sent_message'));
    }else if($user->isDoctor() || $user->isNurse()){
      UnitUser::create([
        'unit_id' => $unit->id,
        'user_id' => $user->id,
        'permission'  => UnitUser::MEMBER,
        'status'  => UnitUser::PENDING,
      ]);
      return redirect()->back()->with('success', __('unit_users.success_sent_message'));
    }else{
      abort(403);
    }
  }
}