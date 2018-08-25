<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Permission;
use App\User;
use App\Models\Patient;

class Permissions extends Controller{
    public function index(Request $request){
        $permissions = Permission::get();
        $links = '';
        $sort = $request->input('sort', '###');
        $search = $request->input('search', '###');

        if($sort != '###' && $search == '###'){
        $permissions = $permissions->orderBy($request->input('sort'), 'desc');
        $permissions = $permissions->paginate(10);
        $links = $permissions->appends(['sort' => $request->input('sort')])->links();
        }else if($sort == '###' && $search != '###'){
        $permissions = $permissions->where('title', 'LIKE', "%$search%");
        $permissions = $permissions->paginate(10);
        $links = $permissions->appends(['sort' => $request->input('sort')])->links();
        }else if($sort != '###' && $search != '###'){
        $permissions = $permissions->where('title', 'LIKE', "%$search%");
        $permissions = $permissions->orderBy($request->input('sort'), 'desc');
        $permissions = $permissions->paginate(10);
        $links = $permissions->appends(['sort' => $request->input('sort')])->links();
        }else{
        $permissions = $permissions->paginate(10);
        }
        return view('panel.permissions.index', [
            'permissions'   => $permissions,
            'links'         => $links,
            'sort'          => $sort,
            'search'        => $search,
        ]);
    }
    public function create(Request $request){
        return view('panel.permissions.create');
    }
    public function check(Request $request){
        $patient = Patient::where('id_number', $request->input('id_number', 0))->first();
        if($patient){
            if(Permission::where(['requester_id' => Auth::user()->id, 'patient_id' => $patient->user->id])->first()){
                return view('panel.permissions.check', ['id_number' => $request->input('id_number', ''), 'result' => 'exists']);
            }else{
                return view('panel.permissions.check', ['id_number' => $request->input('id_number', ''), 'result' => 'found', 'patient' => $patient]);
            }
        }else{
            return view('panel.permissions.check', ['id_number' => $request->input('id_number', ''), 'result' => 'not_found']);
        }
    }
}