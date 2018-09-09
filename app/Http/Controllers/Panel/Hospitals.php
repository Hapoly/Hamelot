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
use App\Models\Province;
use App\Models\City;
use App\User;
use App\Http\Requests\HospitalRequest;

class Hospitals extends Controller{
  public function index(Request $request){
    $hospitals = Hospital::fetch($joined=$request->input('joined', false));
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('title'))
      $hospitals = $hospitals->whereRaw("title LIKE '%". $request->title ."%'");
    if($request->has('address'))
      $hospitals = $hospitals->whereRaw("address LIKE '%". $request->address ."%'");
    if($request->has('status') && $request->status != 0)
      $hospitals = $hospitals->where('status', $request->status);
    if($request->has('province_id') && $request->province_id != 0){
      if($request->has('city_id') && $request->city_id != 0){
        $hospitals = $hospitals->where('city_id', $request->city_id);
      }else{
        $province_id = $request->province_id;
        $hospitals = $hospitals->whereHas('city', function($query) use ($province_id){
          return $query->where('province_id', $province_id);
        });
      }
    }else{
      if($request->has('city_id') && $request->city_id != 0){
        $hospitals = $hospitals->where('city_id', $request->city_id);
      }
    }
    if($request->has('sort'))
      $hospitals = $hospitals->orderBy($request->input('sort'), 'desc');
    $hospitals = $hospitals->paginate(10);
    
    return view('panel.hospitals.index', [
      'hospitals'   => $hospitals,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => parse_url(url()->full())['query'],
      'filters'     => [
        'title'       => $request->input('title', ''),
        'address'     => $request->input('address', ''),
        'province_id' => $request->input('province_id', ''),
        'city_id'     => $request->input('city_id', ''),
        'status'      => $request->input('status'),
      ],
      'provinces'   => Province::all(),
      'cities'      => City::all()
    ]);
  }
  public function show(Hospital $hospital){
    return view('panel.hospitals.show', ['hospital' => $hospital]);
  }
  public function create(){
    return view('panel.hospitals.create', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
    ]);
  }
  public function store(HospitalRequest $request){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::disk('public')->put('/hospitals', $request->file('image'));
    $hospital = Hospital::create($inputs);
    return redirect()->route('panel.hospitals.show', ['hospital' => $hospital]);
  }
  public function edit(Hospital $hospital){
    return view('panel.hospitals.edit', [
      'hospital'  => $hospital,
      'provinces' => Province::all(),
      'cities'    => City::all()
    ]);
  }
  public function update(HospitalRequest $request, Hospital $hospital){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::disk('public')->put('/hospitals', $request->file('image'));
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
