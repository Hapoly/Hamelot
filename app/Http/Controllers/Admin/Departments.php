<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Hospital;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;

class Departments extends Controller{
  public function index(Request $request){
    $departments = new Department;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $departments = $departments->orderBy($request->input('sort'), 'desc');
      $departments = $departments->paginate(10);
      $links = $departments->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $departments = $departments->where('title', 'LIKE', "%$search%");
      $departments = $departments->paginate(10);
      $links = $departments->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $departments = $departments->where('title', 'LIKE', "%$search%");
      $departments = $departments->orderBy($request->input('sort'), 'desc');
      $departments = $departments->paginate(10);
      $links = $departments->appends(['sort' => $request->input('sort')])->links();
    }else{
      $departments = $departments->paginate(10);
    }
    return view('admin.departments.index', [
      'departments'   => $departments,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Department $department){
    return view('admin.departments.show', ['department' => $department]);
  }
  public function create(){
    return view('admin.departments.create',
      ['hospitals' => Hospital::where('status', Hospital::S_ACTIVE)->get()]);
  }
  public function store(DepartmentRequest $request){
    $department = Department::create($request->all());
    return redirect()->route('admin.departments.show', ['department' => $department]);
  }
  public function edit(Department $department){
    return view('admin.departments.edit', ['department' => $department, 'hospitals' => Hospital::where('status', Hospital::S_ACTIVE)->get()]);
  }
  public function update(DepartmentRequest $request, Department $department){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::put('public/departments', $request->file('image'));
    $department->fill($inputs)->save();
    return redirect()->route('admin.departments.show', ['department' => $department]);
  }
  public function destroy(Department $department){
    $department->delete();
    if(URL::route('admin.departments.show', ['department' => $department]) == URL::previous())
      return redirect()->route('admin.departments.index');
    else
      return redirect()->back();
  }
}
