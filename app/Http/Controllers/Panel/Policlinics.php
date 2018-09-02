<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Policlinic;
use App\Models\Province;
use App\Models\City;
use App\User;
use App\Http\Requests\PoliclinicRequest;

class Policlinics extends Controller{
  public function index(Request $request){
    $policlinics = Policlinic::fetch($joined=$request->input('joined', false));
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $policlinics = $policlinics->orderBy($request->input('sort'), 'desc');
      $policlinics = $policlinics->paginate(10);
      $links = $policlinics->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $policlinics = $policlinics->where('title', 'LIKE', "%$search%");
      $policlinics = $policlinics->paginate(10);
      $links = $policlinics->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $policlinics = $policlinics->where('title', 'LIKE', "%$search%");
      $policlinics = $policlinics->orderBy($request->input('sort'), 'desc');
      $policlinics = $policlinics->paginate(10);
      $links = $policlinics->appends(['sort' => $request->input('sort')])->links();
    }else{
      $policlinics = $policlinics->paginate(10);
    }
    return view('panel.policlinics.index', [
      'policlinics'   => $policlinics,
      'links'         => $links,
      'sort'          => $sort,
      'search'        => $search,
    ]);
  }
  public function show(Policlinic $policlinic){
    return view('panel.policlinics.show', ['policlinic' => $policlinic]);
  }
  public function create(){
    return view('panel.policlinics.create', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
    ]);
  }
  public function store(PoliclinicRequest $request){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/policlinics', $request->file('image'));
    $inputs['image'] = 'NuLL';
    $policlinic = Policlinic::create($inputs);
    return redirect()->route('panel.policlinics.show', ['policlinic' => $policlinic]);
  }
  public function edit(Policlinic $policlinic){
    return view('panel.policlinics.edit', [
      'policlinic'  => $policlinic,
      'provinces' => Province::all(),
      'cities'    => City::all()
    ]);
  }
  public function update(PoliclinicRequest $request, Policlinic $policlinic){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/policlinics', $request->file('image'));
    $policlinic->fill($inputs)->save();
    return redirect()->route('panel.policlinics.show', ['policlinic' => $policlinic]);
  }
  public function destroy(Policlinic $policlinic){
    $policlinic->delete();
    if(URL::route('panel.policlinics.show', ['policlinic' => $policlinic]) == URL::previous())
      return redirect()->route('panel.policlinics.index');
    else
      return redirect()->back();
  }
}
