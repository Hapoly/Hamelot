<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Carbon\Carbon;
use URL;
use Auth;

use App\User;
use App\Models\Doctor;
use App\Models\Patient;

use App\Http\Requests\Api\Auth\TokenSend as SendTokenRequest;
use App\Http\Requests\Api\Auth\TokenVerify as VerifyTokenRequest;

use App\Http\Resources\User as UserResource;

class Authorizaition extends Controller{
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

    public function sendToken(SendTokenRequest $request){
        $request->session()->put('auth.phone', $this->replace_digits($request->phone));
        $request->session()->put('auth.token', rand(10000, 99999));
        $request->session()->put('auth.group_code', $request->group_code);
        try{
            $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
            $template = env('KAVENEGAR_PATTERN');
            $result = $api->VerifyLookup(
                        $request->session()->get('auth.phone'),
                        $request->session()->get('auth.token'), 
                        '', '',
                        $template,'sms'
                    );
            return response()->json([
                'message'   => 'token sent to client phone',
            ], 200);
        }catch(ApiException $e){
            return response()->json([
                'message'   => 'server internal error for communicating with sms api'
            ]);
        }catch(HttpException $e){
            return response()->json([
                'message'   => 'server internal error for communicating with sms api'
            ]);
        }
    }
    public function verifyToken(VerifyTokenRequest $request){
        $phone = $request->session()->get('auth.phone', 'NuLL');
        $user = User::where('phone', $phone)->first();
        if(!$user){
            $group_code = $request->session()->get('auth.group_code');
            $user = User::create([
                'phone'         => $phone,
                'group_code'    => $group_code,
            ]);
            switch($group_code){
                case User::G_PATIENT:
                    Patient::create([
                        'user_id'   => $user->id,
                    ]);
                    break;
                case User::G_DOCTOR:
                    Doctor::create([
                        'user_id'   => $user->id,
                    ]);
                    break;
            }
        }else{
            if($user->group_code != $request->session()->get('auth.group_code')){
                return response()->json([
                    'message'   => 'another user with another group_code has been authorized',
                ], 401);
            }
        }
        $request->session()->flush();
        Auth::login($user);
        
        // generating token for output
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(2);
        else
            $token->expires_at = Carbon::now()->addHours(48);
        $token->save();
        return response()->json([
            'access_token'  => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'user'          => UserResource::make($user),
            'expires_at'    => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function logout(Request $request){
        Auth::user()->token()->revoke();
        $request->session()->flush();
        return response()->json([
            "message"   => "logged out successfully",
        ], 200);
    }
}