<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ForgotPassword as FrogotPasswordRequest;
use App\Http\Requests\Auth\ResetPassword as ResetPasswordRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function forgotPassword(){
        return view('auth.passwords.phone');
    }
    public function sendSms(FrogotPasswordRequest $request){
        $user = User::where('phone', $request->phone)->firstOrFail();
        // sending message to phone number
        $request->session()->put('forgot.password.phone'      , $request->phone);
        $request->session()->put('forgot.password.token'      , rand() % 1000000);
        try{
            $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
            $template = env('KAVENEGAR_PATTERN');
            $result = $api->VerifyLookup(
                        $request->session()->get('forgot.password.phone'),
                        $request->session()->get('forgot.password.token'), 
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
        return view('auth.passwords.reset');
    }
    public function resetPassword(ResetPasswordRequest $request){
        if(intval($request->token) != $request->session()->get('forgot.password.token')){
            // return $request->all();
            $request->session()->put('register.token_mismatch', true);
            return view('auth.passwords.reset');
        }else{
            $request->session()->put('register.token_mismatch', false);
        }
        $user = User::where('phone', $request->session()->get('forgot.password.phone'))->first();
        return redirect('login')->with('password_changed', true);
    }
}
