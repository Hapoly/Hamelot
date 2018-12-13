<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavenegar\KavenegarApi;
use App\User;
use Auth;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Province;
use App\Models\City;

use App\Http\Requests\Auth\Login as LoginRequest;
use App\Http\Requests\Auth\Check as CheckRequest;

use App\Http\Requests\Auth\CreateDoctor as CreateDoctorRequest;
use App\Http\Requests\Auth\CreateNurse as CreateNurseRequest;

class AuthController extends Controller{
    public function login(Request $request){
        $request->session()->put('auth.group', $request->group);
        // return $request->session()->get('auth');
        return view('auth.login.phone');
    }
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
    public function sendToken(LoginRequest $request){
        $request->session()->put('auth.phone', $this->replace_digits($request->phone));
        $request->session()->put('auth.token', rand(10000, 99999));
        try{
            $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
            $template = env('KAVENEGAR_PATTERN');
            $result = $api->VerifyLookup(
                        $request->session()->get('auth.phone'),
                        $request->session()->get('auth.token'), 
                        '', '',
                        $template,'sms'
                    );
            return redirect()->route('token')->with(['resend' => $request->input('again', false)]);
        }catch(ApiException $e){
            return redirect()->route('login');
        }catch(HttpException $e){
            return redirect()->route('login');
        }
    }

    public function token(Request $request){
        // return $request->session()->all();
        return view('auth.login.token', ['phone' => $request->session()->get('auth.phone')]);
    }
    public function check(CheckRequest $request){
        $user = User::where('phone', $request->session()->get('auth.phone'))->first();
        switch($request->session()->get('auth.group')){
            case User::G_ADMIN:
                if($user){
                    if($user->isAdmin()){
                        Auth::login($user);
                        return redirect()->route('home');
                    }else{
                        return redirect()->back()->with(['failed' => true]);
                    }
                }else
                    return redirect()->back()->with(['failed' => true]);
            case User::G_MANAGER:
            case User::G_SECRETARY:
            case User::G_PATIENT:
                if($user){
                    if($user->isManager()){
                        Auth::login($user);
                        return redirect()->route('home');
                    }else{
                        return redirect()->back()->with(['failed' => true]);
                    }
                }else{
                    $user = User::create([
                        'phone'         => $request->session()->get('auth.phone'),
                        'group_code'    => $request->session()->get('auth.group'),
                    ]);
                    if($request->session()->get('auth.group') == User::G_PATIENT){
                        Patient::create([
                            'user_id'   => $user->id
                        ]);
                    }
                    Auth::login($user);
                    return redirect()->route('home');
                }
            case User::G_DOCTOR:
            case User::G_NURSE:
                if($user){
                    if($user->isNurse() || $user->isDoctor()){
                        Auth::login($user);
                        return redirect()->route('home');
                    }else{
                        return redirect()->back()->with(['failed' => true]);
                    }
                }else{
                    $user = User::create([
                        'phone'         => $request->session()->get('auth.phone'),
                        'group_code'    => $request->session()->get('auth.group'),
                    ]);
                    if($request->session()->get('auth.group') == User::G_DOCTOR){
                        Doctor::create([
                            'user_id'   => $user->id
                        ]);
                    }else if($request->session()->get('auth.group') == User::G_NURSE){
                        Nurse::create([
                            'user_id'   => $user->id
                        ]);
                    }
                    Auth::login($user);
                    return redirect()->route('panel.profile');
                }
        }
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
