<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Template;
use App\Models\Key;
use App\Http\Requests\KeyRequest;

class Keys extends Controller{
  public function index(Request $request){
    $keys = new Key;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $keys = $keys->orderBy($request->input('sort'), 'desc');
      $keys = $keys->paginate(10);
      $links = $keys->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $keys = $keys->where('title', 'LIKE', "%$search%");
      $keys = $keys->paginate(10);
      $links = $keys->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $keys = $keys->where('title', 'LIKE', "%$search%");
      $keys = $keys->orderBy($request->input('sort'), 'desc');
      $keys = $keys->paginate(10);
      $links = $keys->appends(['sort' => $request->input('sort')])->links();
    }else{
      $keys = $keys->paginate(10);
    }
    return view('admin.keys.index', [
      'keys'   => $keys,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Key $key){
    return view('admin.keys.show', ['key' => $key]);
  }
  public function create(){
    return view('admin.keys.create',
      ['templates' => Template::where('status', Template::S_ACTIVE)->get()]);
  }
  public function store(KeyRequest $request){
    $key = Key::create($request->all());
    return redirect()->route('keys.show', ['key' => $key]);
  }
  public function edit(Key $key){
    return view('admin.keys.edit', ['key' => $key, 'templates' => Template::where('status', Template::S_ACTIVE)->get()]);
  }
  public function update(KeyRequest $request, Key $key){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/keys', $request->file('image'));
    $key->fill($inputs)->save();
    return redirect()->route('keys.show', ['key' => $key]);
  }
  public function destroy(Key $key){
    $key->delete();
    if(URL::route('keys.show', ['key' => $key]) == URL::previous())
      return redirect()->route('keys.index');
    else
      return redirect()->back();
  }
}
