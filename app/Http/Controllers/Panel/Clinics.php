<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Clinic;
use App\Models\Province;
use App\Models\City;
use App\User;
use App\Http\Requests\ClinicRequest;

class Clinics extends Controller{
  public function index(Request $request){
    $clinics = Clinic::fetch($joined=$request->input('joined', false));
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $clinics = $clinics->orderBy($request->input('sort'), 'desc');
      $clinics = $clinics->paginate(10);
      $links = $clinics->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $clinics = $clinics->where('title', 'LIKE', "%$search%");
      $clinics = $clinics->paginate(10);
      $links = $clinics->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $clinics = $clinics->where('title', 'LIKE', "%$search%");
      $clinics = $clinics->orderBy($request->input('sort'), 'desc');
      $clinics = $clinics->paginate(10);
      $links = $clinics->appends(['sort' => $request->input('sort')])->links();
    }else{
      $clinics = $clinics->paginate(10);
    }
    return view('panel.clinics.index', [
      'clinics'   => $clinics,
      'links'         => $links,
      'sort'          => $sort,
      'search'        => $search,
    ]);
  }
  public function show(Clinic $clinic){
    return view('panel.clinics.show', ['clinic' => $clinic]);
  }
  public function create(){
    return view('panel.clinics.create', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
    ]);
  }
  public function store(ClinicRequest $request){
    $inputs = $request->all();

    $doctor = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->doctor_name ."'")->first();
    if(!$doctor)
      return redirect()->route('panel.clinics.index');
    $inputs['doctor_id'] = $doctor->id;
    if($request->hasFile('image'))
      $inputs['image'] = Storage::disk('public')->put('/clinics', $request->file('image'));
    $clinic = Clinic::create($inputs);
    return redirect()->route('panel.clinics.show', ['clinic' => $clinic]);
  }
  public function edit(Clinic $clinic){
    return view('panel.clinics.edit', [
      'clinic'  => $clinic,
      'provinces' => Province::all(),
      'cities'    => City::all()
    ]);
  }
  public function update(ClinicRequest $request, Clinic $clinic){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::disk('public')->put('/clinics', $request->file('image'));
    $clinic->fill($inputs)->save();
    return redirect()->route('panel.clinics.show', ['clinic' => $clinic]);
  }
  public function destroy(Clinic $clinic){
    $clinic->delete();
    if(URL::route('panel.clinics.show', ['clinic' => $clinic]) == URL::previous())
      return redirect()->route('panel.clinics.index');
    else
      return redirect()->back();
  }
}
