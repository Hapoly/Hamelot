<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Patient;
use App\Http\Requests\PatientRequest;

class Patients extends Controller{
  public function index(Request $request){
    $patients = new Patient;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $patients = $patients->orderBy($request->input('sort'), 'desc');
      $patients = $patients->paginate(10);
      $links = $patients->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $patients = $patients->where('id_number', 'LIKE', "%$search%");
      $patients = $patients->paginate(10);
      $links = $patients->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $patients = $patients->where('id_number', 'LIKE', "%$search%");
      $patients = $patients->orderBy($request->input('sort'), 'desc');
      $patients = $patients->paginate(10);
      $links = $patients->appends(['sort' => $request->input('sort')])->links();
    }else{
      $patients = $patients->paginate(10);
    }
    return view('admin.patients.index', [
      'patients'   => $patients,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Patient $patient){
    return view('admin.patients.show', ['patient' => $patient]);
  }
  public function create(){
    return view('admin.patients.create');
  }
  public function store(PatientRequest $request){
    $inputs = $request->all();
    $inputs['image'] = Storage::put('public/patients', $request->file('image'));
    $patient = Patient::create($inputs);
    return redirect()->route('patients.show', ['patient' => $patient]);
  }
  public function edit(Patient $patient){
    return view('admin.patients.edit', ['patient' => $patient]);
  }
  public function update(PatientRequest $request, Patient $patient){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/patients', $request->file('image'));
    $patient->fill($inputs)->save();
    return redirect()->route('patients.show', ['patient' => $patient]);
  }
  public function destroy(Patient $patient){
    $patient->delete();
    if(URL::route('patients.show', ['patient' => $patient]) == URL::previous())
      return redirect()->route('patients.index');
    else
      return redirect()->back();
  }
}
