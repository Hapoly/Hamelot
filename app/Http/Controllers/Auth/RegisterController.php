<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\ConstValue;
use Illuminate\Support\Facades\Storage;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use Auth;
use App\Http\Requests\Auth\Register as RegisterRequest;
use App\Http\Requests\Auth\CreateDoctor as CreateDoctorRequest;

class RegisterController extends Controller{
    public function register(){
        return view('auth.register');
    }
    public function moreInfo(RegisterRequest $request){
        switch($request->group_code){
            case 2:
                return view('auth.more_info.manager');
            case 3:
                return view('auth.more_info.doctor', [
                    'request'   => $request,
                    'degrees'   => ConstValue::where('type', 1)->get(),
                    'fields'    => ConstValue::where('type', 2)->get(),
                ]);
            case 4:
                return view('auth.more_info.nurse');
            case 5:
                return view('auth.more_info.patient');
        }
    }
    public function createDoctor(CreateDoctorRequest $request){
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        $user = User::create($data);
        $data['user_id'] = $user->id;
        Doctor::create($data);
        Auth::attempt([
            'username'  => $request->username,
            'password'  => $request->password,
        ]);
        return redirect()->route('search');
    }
}
