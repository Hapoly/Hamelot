<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Check as CheckRequest;
use App\Http\Requests\Auth\Login as LoginRequest;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class AuthController extends Controller {
  public function login(Request $request) {
    $request->session()->put('auth.group', $request->input('group', 5));
    // return $request->session()->get('auth');
    return view('auth.login.phone');
  }
  private function replace_digits($str) {
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
    foreach ($digit_translates as $persian => $latina) {
      $str = str_replace($persian, $latina, $str);
    }
    return $str;
  }
  public function sendToken(LoginRequest $request) {
    $request->session()->put('auth.phone', $this->replace_digits($request->phone));
    $request->session()->put('auth.token', rand(10000, 99999));
    try {
      $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
      $template = env('KAVENEGAR_PATTERN');
      $result = $api->VerifyLookup(
        $request->session()->get('auth.phone'),
        $request->session()->get('auth.token'),
        '', '',
        $template, 'sms'
      );
      return redirect()->route('token')->with(['resend' => $request->input('again', false)]);
    } catch (ApiException $e) {
      return redirect()->route('login', ['group' => $request->session()->get('auth.group')]);
    } catch (HttpException $e) {
      return redirect()->route('login', ['group' => $request->session()->get('auth.group')]);
    }
  }

  public function token(Request $request) {
    // return $request->session()->all();
    $request->session()->forget('accepted_terms');
    if (User::where('phone', $request->session()->get('auth.phone'))->first() != null) {
      $request->session()->put('accepted_terms', true);
    }

    return view('auth.login.token', ['phone' => $request->session()->get('auth.phone')]);
  }
  public function check(CheckRequest $request) {
    $user = User::where('phone', $request->session()->get('auth.phone'))->first();
    switch ($request->session()->get('auth.group')) {
    case User::G_ADMIN:
      if ($user) {
        if ($user->isAdmin()) {
          Auth::login($user);
          return redirect()->route('home');
        } else {
          return redirect()->back()->with(['failed' => true]);
        }
      } else {
        return redirect()->back()->with(['failed' => true]);
      }

    case User::G_MANAGER:
    case User::G_SECRETARY:
    case User::G_PATIENT:
      if ($user) {
        Auth::login($user);
        if ($user->group_code != User::G_PATIENT) {
          return redirect()->route('home');
        } else {
          return redirect()->intended();
        }

      } else {
        $user = User::create([
          'phone' => $request->session()->get('auth.phone'),
          'group_code' => $request->session()->get('auth.group'),
          'slug' => rand(0, 99999999),
        ]);
        if ($request->session()->get('auth.group') == User::G_PATIENT) {
          Patient::create([
            'user_id' => $user->id,
          ]);
        }
        Auth::login($user);
        if ($user->group_code != User::G_PATIENT) {
          return redirect()->route('home');
        } else {
          return redirect()->intended();
        }

      }
    case User::G_DOCTOR:
    case User::G_NURSE:
      if ($user) {
        if ($user->group_code == $request->session()->get('auth.group')) {
          Auth::login($user);
          return redirect()->route('home');
        } else {
          return redirect()->back()->with(['failed' => true]);
        }
      } else {
        $user = User::create([
          'phone' => $request->session()->get('auth.phone'),
          'group_code' => $request->session()->get('auth.group'),
          'slug' => rand(0, 99999999),
        ]);
        if ($request->session()->get('auth.group') == User::G_DOCTOR) {
          Doctor::create([
            'user_id' => $user->id,
          ]);
        } else if ($request->session()->get('auth.group') == User::G_NURSE) {
          Nurse::create([
            'user_id' => $user->id,
          ]);
        }
        Auth::login($user);
        return redirect()->route('panel.profile');
      }
    }
  }
  public function logout(Request $request) {
    Auth::logout();
    return redirect()->route('welcome');
  }
}
