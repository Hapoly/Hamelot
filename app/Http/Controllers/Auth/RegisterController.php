<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\ConstValue;
use Illuminate\Support\Facades\Storage;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use App\Drivers\Time;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use Auth;
use App\Http\Requests\Auth\Register as RegisterRequest;
use App\Http\Requests\Auth\CreateManager as CreateManagerRequest;
use App\Http\Requests\Auth\CreateDoctor as CreateDoctorRequest;
use App\Http\Requests\Auth\CreateNurse as CreateNurseRequest;
use App\Http\Requests\Auth\CreatePatient as CreatePatientRequest;

class RegisterController extends Controller{
    private function replace_digits($str){
        $digit_translates = [
            '۰' => '0',
            '۱' => '1',
            '۲' => '2',
            '۳' => '3',
            '۴' => '4',
            '۵' => '5',
            '۶' => '6',
            '۷' => '7',
            '۸' => '8',
            '۹' => '9',
        ];
        foreach($digit_translates as $persian=>$latina){
            $str = str_replace($persian, $latina, $str);
        }
        return $str;
    }
    public function register(Request $request){
        $request->session()->flush();
        return view('auth.register');
    }
    public function moreInfo(RegisterRequest $request){
        $inputs = $request->all();
        $inputs['phone'] = $this->replace_digits($request->phone);
        if(!$request->session()->has('token') && !$request->session()->get('register.token_mismatch', false)){
            $request->session()->put('register.username'   , $inputs['username']);
            $request->session()->put('register.password'   , $inputs['password']);
            $request->session()->put('register.first_name' , $inputs['first_name']);
            $request->session()->put('register.last_name'  , $inputs['last_name']);
            $request->session()->put('register.group_code' , $inputs['group_code']);
            $request->session()->put('register.phone'      , $inputs['phone']);
            $request->session()->put('register.token'      , rand() % 1000000);
            // sending message to phone number
            try{
                $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
                $template = env('KAVENEGAR_PATTERN');
                $result = $api->VerifyLookup(
                            $request->session()->get('register.phone'),
                            $request->session()->get('register.token'), 
                            '', '',
                            $template,'sms'
                        );
            }
            catch(ApiException $e){
                echo $e->errorMessage();
            }
            catch(HttpException $e){
                echo $e->errorMessage();
            }
        }
        switch($request->group_code){
            case 2:
                return view('auth.more_info.manager', [
                    'request'   => $request,
                ]);
            case 3:
                return view('auth.more_info.doctor', [
                    'degrees'   => ConstValue::where('type', 1)->get(),
                    'fields'    => ConstValue::where('type', 2)->get(),
                ]);
            case 4:
                return view('auth.more_info.nurse', [
                    'request'   => $request,
                    'degrees'   => ConstValue::where('type', 3)->get(),
                    'fields'    => ConstValue::where('type', 4)->get(),
                ]);
            case 5:
                return view('auth.more_info.patient', [
                    'request'   => $request,
                ]);
        }
    }
    public function createDoctor(CreateDoctorRequest $request){
        $data = $request->all();
        $data['token'] = $this->replace_digits($data['token']);
        if($data['token'] != $request->session()->get('register.token')){
            $request->session()->put('register.token_mismatch', true);
            return redirect()->back();
        }
        $data['username'] = $request->session()->get('register.username');
        $data['first_name'] = $request->session()->get('register.first_name');
        $data['last_name'] = $request->session()->get('register.last_name');
        $data['phone'] = $request->session()->get('register.phone');
        $data['group_code'] = $request->session()->get('register.group_code');
        $data['password'] = Hash::make($request->session()->get('register.password'));
        if($request->hasFile('profile'))
            $data['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        $user = User::create($data);
        $data['user_id'] = $user->id;
        Doctor::create($data);
        $request->session()->flush();
        Auth::attempt([
            'username'  => $request->username,
            'password'  => $request->password,
        ]);
        return redirect()->route('home');
    }
    public function createNurse(CreateNurseRequest $request){
        $data = $request->all();
        $data['token'] = $this->replace_digits($data['token']);
        if($data['token'] != $request->session()->get('register.token')){
            $request->session()->put('register.token_mismatch', true);
            return redirect()->back();
        }
        $data['username'] = $request->session()->get('register.username');
        $data['first_name'] = $request->session()->get('register.first_name');
        $data['last_name'] = $request->session()->get('register.last_name');
        $data['phone'] = $request->session()->get('register.phone');
        $data['group_code'] = $request->session()->get('register.group_code');
        $data['password'] = Hash::make($request->session()->get('register.password'));
        if($request->hasFile('profile'))
            $data['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        $user = User::create($data);
        $data['user_id'] = $user->id;
        Nurse::create($data);
        $request->session()->flush();
        Auth::attempt([
            'username'  => $request->username,
            'password'  => $request->password,
        ]);
        return redirect()->route('home');
    }
    public function createPatient(CreatePatientRequest $request){
        $data = $request->all();
        $data['token'] = $this->replace_digits($data['token']);
        if($data['token'] != $request->session()->get('register.token')){
            $request->session()->put('register.token_mismatch', true);
            return redirect()->back();
        }
        $data['username'] = $request->session()->get('register.username');
        $data['first_name'] = $request->session()->get('register.first_name');
        $data['last_name'] = $request->session()->get('register.last_name');
        $data['phone'] = $request->session()->get('register.phone');
        $data['group_code'] = $request->session()->get('register.group_code');
        $data['password'] = Hash::make($request->session()->get('register.password'));
        $data['birth_date'] = Time::jmktime(0, 0, 0, $data['birth_day'], $data['birth_month'], $data['birth_year']);
        if($request->hasFile('profile'))
            $data['profile'] = Storage::disk('public')->put('/users', $request->file('profile'));
        $user = User::create($data);
        $data['user_id'] = $user->id;
        Patient::create($data);
        $request->session()->flush();
        Auth::attempt([
            'username'  => $request->username,
            'password'  => $request->password,
        ]);
        return redirect()->route('home');
    }
    public function createManager(CreateManagerRequest $request){
        $data = $request->all();
        $data['token'] = $this->replace_digits($data['token']);
        if($data['token'] != $request->session()->get('register.token')){
            $request->session()->put('register.token_mismatch', true);
            return redirect()->back();
        }
        $data['username'] = $request->session()->get('register.username');
        $data['first_name'] = $request->session()->get('register.first_name');
        $data['last_name'] = $request->session()->get('register.last_name');
        $data['phone'] = $request->session()->get('register.phone');
        $data['group_code'] = $request->session()->get('register.group_code');
        $data['password'] = Hash::make($request->session()->get('register.password'));
        $user = User::create($data);
        $request->session()->flush();
        Auth::attempt([
            'username'  => $request->username,
            'password'  => $request->password,
        ]);
        return redirect()->route('home');
    }
}
