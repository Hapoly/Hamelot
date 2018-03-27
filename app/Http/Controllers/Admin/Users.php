<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\User;
use App\Subject;
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
    return view('admin.users.show', ['exam' => $user]);
  }
  public function create(){
    return view('admin.users.create');
  }
  public function store(UserRequest $request){
    $user = User::create($request->all());
    return redirect()->route('admin.users.show', ['exam' => $user]);
  }
  public function edit(Exam $user){
    // $start_date = \App\Drivers\Time::jgetdate($user->start_date);
    // return $start_date;
    return view('admin.users.edit', [
      'subjects'  => Subject::where(['status' => Subject::ACTIVE])->get(),
      'exam'      => $user,
    ]);
  }
  public function update(UserRequest $request, Exam $user){
    $inputs = $request->all();
    switch($request->type){
      case 1:
        $inputs['start_date'] = \App\Drivers\Time::jmktime(0,$request->start_min, $request->start_hour, $request->day, $request->month, $request->year);
        $inputs['end_date'] = \App\Drivers\Time::jmktime(0,$request->end_min, $request->end_hour, $request->day, $request->month, $request->year);
        break;
      case 2:
        unset($inputs['time']);
        $inputs['start_date'] = \App\Drivers\Time::jmktime(0,$request->start_min, $request->start_hour, $request->day, $request->month, $request->year);
        $inputs['end_date'] = \App\Drivers\Time::jmktime(0,$request->end_min, $request->end_hour, $request->day, $request->month, $request->year);
        // return $inputs;
        break;
      case 3:
        unset($inputs['time']);
        $inputs['start_date'] = \App\Drivers\Time::jmktime(0,0,0 , $request->day, $request->month, $request->year);
        $inputs['end_date'] = \App\Drivers\Time::jmktime(0,0,0 , $request->day, $request->month, $request->year);
        break;
    }
    $user->fill($inputs)->save();
    return redirect()->route('admin.users.show', ['exam' => $user]);
  }
  public function destroy(Exam $user){
    $user->delete();
    if(URL::route('admin.users.show', ['exam' => $user]) == URL::previous())
      return redirect()->route('admin.users.index');
    else
      return redirect()->back();
  }
}