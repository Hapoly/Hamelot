<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests\Api\Register\PatientRequest;
use App\Http\Requests\Api\LoginRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use URL;
use Response;
use Auth as AuthUnit;
use Carbon\Carbon;

use App\User;
use App\Models\Patient;
use App\Http\Resources\User as UserCollection;

class Auth extends Controller{
    public function login(Request $request){
        $validation = new LoginRequest($request);
        if($validation->fails())
            return Response::json($validation->errors(), 400);

        $credentials = request(['username', 'password']);
        if(!AuthUnit::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
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
}