<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\Register\PatientRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Unit;
use URL;
use Response;

use App\User;
use App\Models\Patient;
use App\Http\Resources\User as UserCollection;

class Auth extends Controller{
    public function registerPatient(Request $request){
        $validation = new PatientRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 401);
        $inputs = $request->all();
        if($request->hasFile('profile')){
            $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        }
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['group_code'] = User::G_PATIENT;
        $user = User::create($inputs);
        $inputs['user_id'] = $user->id;
        $patient = Patient::create($inputs);
        return new UserCollection($user);
    }
}