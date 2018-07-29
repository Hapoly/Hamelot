<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Hospital;
use App\Http\Requests\HospitalRequest;

class Hospitals extends Controller{
  public function index(Request $request){
    $hospitals = new Hospital;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $hospitals = $hospitals->orderBy($request->input('sort'), 'desc');
      $hospitals = $hospitals->paginate(10);
      $links = $hospitals->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $hospitals = $hospitals->where('title', 'LIKE', "%$search%");
      $hospitals = $hospitals->paginate(10);
      $links = $hospitals->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $hospitals = $hospitals->where('title', 'LIKE', "%$search%");
      $hospitals = $hospitals->orderBy($request->input('sort'), 'desc');
      $hospitals = $hospitals->paginate(10);
      $links = $hospitals->appends(['sort' => $request->input('sort')])->links();
    }else{
      $hospitals = $hospitals->paginate(10);
    }
    return view('panel.hospitals.index', [
      'hospitals'   => $hospitals,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Hospital $hospital){
    return view('panel.hospitals.show', ['hospital' => $hospital]);
  }
  public function create(){
    return view('panel.hospitals.create');
  }
  public function store(HospitalRequest $request){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/hospitals', $request->file('image'));
    $inputs['image'] = 'NuLL';
    $hospital = Hospital::create($inputs);
    return redirect()->route('panel.hospitals.show', ['hospital' => $hospital]);
  }
  public function edit(Hospital $hospital){
    return view('panel.hospitals.edit', ['hospital' => $hospital]);
  }
  public function update(HospitalRequest $request, Hospital $hospital){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/hospitals', $request->file('image'));
    $hospital->fill($inputs)->save();
    return redirect()->route('panel.hospitals.show', ['hospital' => $hospital]);
  }
  public function destroy(Hospital $hospital){
    $hospital->delete();
    if(URL::route('panel.hospitals.show', ['hospital' => $hospital]) == URL::previous())
      return redirect()->route('panel.hospitals.index');
    else
      return redirect()->back();
  }
}
