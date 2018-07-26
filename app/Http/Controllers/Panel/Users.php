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
use App\Http\Requests\UserRequest;

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
  public function createAdmin(){
    return view('panel.users.create.admin');
  }
  public function createManager(){
    return view('panel.users.create.manager');
  }
  public function createDoctor(){
    return view('panel.users.create.doctor');
  }
  public function createNurse(){
    return view('panel.users.create.nurse');
  }
  public function createPatient(){
    return view('panel.users.create.patient');
  }
  /**
   * store users in user groups
   */
  public function store(UserRequest $request){
    $inputs = $request->all();
    $inputs['password'] = bcrypt($inputs['password']);
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
