<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Hospital;
use App\User;

use App\Http\Requests\PatientRequest;

class Patients extends Controller{
  public function index(Request $request){
    $patients = Auth::user()->patients();
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
    return view('manager.patients.index', [
      'patients'    => $patients,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Patient $patient){
    return view('manager.patients.show', ['patient' => $patient]);
  }
  public function create(Request $request){
    $departments = Department::whereHas('hospital', function($query){
      return $query->whereHas('users', function($query){
        return $query->where('user_id', Auth::user()->id);
      });
    })->get();

    if($request->has('department'))
      return view('manager.patients.create',
        [
          'selected_department' => Hospital::where('id', $request->input('department'))->first(),
          'departments' => $departments,
        ]);
    return view('manager.patients.create',['departments' => $departments]);
  }
  public function store(PatientRequest $request){
    $inputs = $request->all();
    $inputs['image'] = Storage::put('public/patients', $request->file('image'));
    $patient = Patient::create($inputs);
    return redirect()->route('patients.show', ['patient' => $patient]);
  }
  public function edit(Patient $patient){
    return view('manager.patients.edit', ['patient' => $patient]);
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
