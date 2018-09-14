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
        $permissions = Permission::fetch();
        $links = '';
        $sort = $request->input('sort', '###');

        if($request->has('status') && $request->status != 0)
            $permissions = $permissions->where('status', $request->status);
        if($request->has('requester_id')){
            $requester = User::getByName($request->requester_id);
            if($requester){
                $permissions = $permissions->where('requester_id', $requester->id);
            }
        }
        if($request->has('patient_id')){
            $patient = User::getByName($request->patient_id);
            if($patient)
                $permissions = $permissions->where('patient_id', $patient->id);
        }
        if($request->has('sort'))
            $permissions = $permissions->orderBy($request->input('sort'), 'desc');
        $permissions = $permissions->paginate(10);
        return view('panel.permissions.index', [
            'permissions'   => $permissions,
            'links'         => $links,
            'sort'          => $sort,
            'search'          => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
            'filters'         => [
              'status'              => $request->input('status', 0),
              'requester_name'      => $request->input('requester_id', ''),
              'patient_name'        => $request->input('patient_id', ''),
            ],
        ]);
    }
    public function create(Request $request){
        return view('panel.permissions.create');
    }
    public function check(Request $request){
        $patient = Patient::where('id_number', $request->input('id_number', 0))->first();
        if($patient){
            if(Permission::where(['requester_id' => Auth::user()->id, 'patient_id' => $patient->user->id, 'status' => Permission::ACCEPTED])->first()){
                return view('panel.permissions.check', ['id_number' => $request->input('id_number', ''), 'result' => 'exists', 'patient' => $patient->user]);
            }else{
                return view('panel.permissions.check', ['id_number' => $request->input('id_number', ''), 'result' => 'found', 'patient' => $patient->user]);
            }
        }else{
            return view('panel.permissions.check', ['id_number' => $request->input('id_number', ''), 'result' => 'not_found']);
        }
    }

    public function send(Request $request, User $user){
        $permission = new Permission;
        $permission->patient_id = $user->id;
        $permission->requester_id = Auth::user()->id;
        $permission->save();
        return redirect()->route('panel.permissions.show', ['permission' => $permission]);
    }

    public function show(Request $request, Permission $permission){
        return view('panel.permissions.show', ['permission' => $permission]);
    }
    public function inlineUpdate(Request $request, Permission $permission){
        if($request->has('action')){
            switch($request->action){
                case 'accept':
                    if($permission->canAccept()){
                        $permission->status = Permission::ACCEPTED;
                        $permission->save();
                    }
                    break;
                case 'refuse':
                    if($permission->canRefuse()){
                        $permission->status = Permission::REFUSED;
                        $permission->save();
                    }
                    break;
                case 'cancel':
                    if($permission->canCancel()){
                        $permission->status = Permission::CANCELED;
                        $permission->save();
                    }
                    break;
            }
            return redirect()->route('panel.permissions.show', ['permission' => $permission]);
        }else
            abort(404);
    }
}