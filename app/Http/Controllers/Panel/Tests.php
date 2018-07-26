<?php

namespace App\Http\Controlelrs\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Test;
use App\Http\Requests\TestRequest;

class Tests extends Controller{
    public function index(Request $request){
      $Tests = new Test;
      $links = '';
      $sort = $request->input('sort', '###');
      $search = $request->input('search', '###');
  
      if($sort != '###' && $search == '###'){
        $Tests = $Tests->orderBy($request->input('sort'), 'desc');
        $Tests = $Tests->paginate(10);
        $links = $Tests->appends(['sort' => $request->input('sort')])->links();
      }else if($sort == '###' && $search != '###'){
        $Tests = $Tests->where('username', 'LIKE', "%$search%");
        $Tests = $Tests->paginate(10);
        $links = $Tests->appends(['sort' => $request->input('sort')])->links();
      }else if($sort != '###' && $search != '###'){
        $Tests = $Tests->where('username', 'LIKE', "%$search%");
        $Tests = $Tests->orderBy($request->input('sort'), 'desc');
        $Tests = $Tests->paginate(10);
        $links = $Tests->appends(['sort' => $request->input('sort')])->links();
      }else{
        $Tests = $Tests->paginate(10);
      }
      return view('admin.Tests.index', [
        'Tests'       => $Tests,
        'links'       => $links,
        'sort'        => $sort,
        'search'      => $search,
      ]);
    }
    public function show(User $user){
      return view('admin.Tests.show', ['user' => $user]);
    }
    public function create(){
      return view('admin.Tests.create');
    }
    public function store(UserRequest $request){
      $inputs = $request->all();
      $inputs['password'] = bcrypt($inputs['password']);
      $user = User::create($inputs);
      return redirect()->route('admin.Tests.show', ['user' => $user]);
    }
    public function edit(User $user){
      return view('admin.Tests.edit', ['user' => $user]);
    }
    public function update(UserRequest $request, User $user){
      $inputs = $request->all();
      if($inputs['password'])
        $inputs['password'] = bcrypt($inputs['password']);
      else
        unset($inputs['password']);
  
      $user->fill($inputs)->save();
      return redirect()->route('admin.Tests.show', ['user' => $user]);
    }
    public function destroy(User $user){
      $user->delete();
      if(URL::route('admin.Tests.show', ['user' => $user]) == URL::previous())
        return redirect()->route('admin.Tests.index');
      else
        return redirect()->back();
    }
  }