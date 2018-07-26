<?php

namespace App\Http\Controlelrs\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\HospitalUser;
use App\Models\Hospital;
use App\User;

use App\Http\Requests\HospitalUserRequest;

class HospitalUsers extends Controller{
  public function index(Request $request){
    $hospital_users = new HospitalUser;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $hospital_users = $hospital_users->orderBy($request->input('sort'), 'desc');
      $hospital_users = $hospital_users->paginate(10);
      $links = $hospital_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $hospital_users = $hospital_users->where('hospital_id', 'LIKE', "%$search%");
      $hospital_users = $hospital_users->paginate(10);
      $links = $hospital_users->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $hospital_users = $hospital_users->where('hospital_id', 'LIKE', "%$search%");
      $hospital_users = $hospital_users->orderBy($request->input('sort'), 'desc');
      $hospital_users = $hospital_users->paginate(10);
      $links = $hospital_users->appends(['sort' => $request->input('sort')])->links();
    }else{
      $hospital_users = $hospital_users->paginate(10);
    }
    return view('admin.hospital_users.index', [
      'hospital_users'     => $hospital_users,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(HospitalUser $hospital_user){
    return view('admin.hospital_users.show', ['hospital_user' => $hospital_user]);
  }
  public function create(){
    return view('admin.hospital_users.create', [
      'hospitals' => Hospital::where('status', Hospital::S_ACTIVE)->get(),
      'users'     => User::where('status', User::S_ACTIVE)->get(),
    ]);
  }
  public function store(HospitalUserRequest $request){
    $hospital_user = HospitalUser::create($request->all());
    return redirect()->route('admin.users.show', ['user' => $hospital_user->user]);
  }
  public function edit(HospitalUser $hospital_user){
    return view('admin.hospital_users.edit', [
      'hospital_user'   => $hospital_user,
      'hospitals'       => Hospital::where('status', Hospital::S_ACTIVE)->get(),
      'users'           => User::where('status', User::S_ACTIVE)->get(),
    ]);
  }
  public function update(HospitalUserRequest $request, HospitalUser $hospital_user){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/hospital_users', $request->file('image'));
    $hospital_user->fill($inputs)->save();
    return redirect()->route('admin.hospital_users.show', ['hospital_user' => $hospital_user]);
  }
  public function destroy(HospitalUser $hospital_user){
    $hospital_user->delete();
    if(URL::route('admin.hospital_users.show', ['hospital_user' => $hospital_user]) == URL::previous())
      return redirect()->route('admin.hospital_users.index');
    else
      return redirect()->back();
  }
}
