<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests\Api\Register\PatientRequest;
use App\Http\Requests\Api\Register\DoctorRequest;
use App\Http\Requests\Api\Register\NurseRequest;
use App\Http\Requests\Api\Register\ManagerRequest;

use App\Http\Requests\Api\LoginRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use URL;
use Response;
use Auth as AuthUnit;
use Carbon\Carbon;

use App\User;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Manager;

use App\Http\Resources\User as UserCollection;

class Auth extends Controller{
    /**
     * login a user
     */
    public function login(Request $request){
        $validation = new LoginRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 400);

        $credentials = request(['username', 'password']);
        if(!AuthUnit::attempt($credentials))
            return response()->json([
                "message" => "username and password were wrong, please type again!"
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(2);
        else
            $token->expires_at = Carbon::now()->addHours(48);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    /**
     * register a patient
     */
    public function registerPatient(Request $request){
        $validation = new PatientRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 400);
        $inputs = $request->all();
        if($request->hasFile('profile')){
            $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        }
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['group_code'] = User::G_PATIENT;
        $user = User::create($inputs);
        $inputs['user_id'] = $user->id;
        $patient = Patient::create($inputs);
        return Response::json(new UserCollection($user), 200);
    }
    /**
     * register a doctor
     */
    public function registerDoctor(Request $request){
        $validation = new DoctorRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 400);
        $inputs = $request->all();
        if($request->hasFile('profile')){
            $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        }
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['group_code'] = User::G_DOCTOR;
        $user = User::create($inputs);
        $inputs['user_id'] = $user->id;
        $doctor = Doctor::create($inputs);
        return Response::json(new UserCollection($user), 200);
    }
    /**
     * register a nurse
     */
    public function registerNurse(Request $request){
        $validation = new NurseRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 400);
        $inputs = $request->all();
        if($request->hasFile('profile')){
            $inputs['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        }
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['group_code'] = User::G_NURSE;
        $user = User::create($inputs);
        $inputs['user_id'] = $user->id;
        $nurse = Nurse::create($inputs);
        return Response::json(new UserCollection($user), 200);
    }
    /**
     * register a manager
     */
    public function registerManager(Request $request){
        $validation = new ManagerRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 400);
        $inputs = $request->all();
        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['group_code'] = User::G_MANAGER;
        $user = User::create($inputs);
        return Response::json(new UserCollection($user), 200);
    }

    /**
     * show logged in user informations
     */
    public function me(Request $request){
        return Response::json(new UserCollection(AuthUnit::user()), 200);
    }
    /**
     * kills and logouts user from session
     */
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            "message"   => "logged out successfully",
        ], 200);
    }
}