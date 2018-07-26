<?php

namespace App\Http\Controlelrs\Panel;

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
    return view('admin.users.index', [
      'users'       => $users,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(User $user){
    return view('admin.users.show', ['user' => $user]);
  }
  public function create(){
    return view('admin.users.create');
  }
  public function store(UserRequest $request){
    $inputs = $request->all();
    $inputs['password'] = bcrypt($inputs['password']);
    $user = User::create($inputs);
    return redirect()->route('admin.users.show', ['user' => $user]);
  }
  public function edit(User $user){
    return view('admin.users.edit', ['user' => $user]);
  }
  public function update(UserRequest $request, User $user){
    $inputs = $request->all();
    if($inputs['password'])
      $inputs['password'] = bcrypt($inputs['password']);
    else
      unset($inputs['password']);

    $user->fill($inputs)->save();
    return redirect()->route('admin.users.show', ['user' => $user]);
  }
  public function destroy(User $user){
    $user->delete();
    if(URL::route('admin.users.show', ['user' => $user]) == URL::previous())
      return redirect()->route('admin.users.index');
    else
      return redirect()->back();
  }
}
