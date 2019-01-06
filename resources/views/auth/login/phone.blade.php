@extends('layouts.app')
@section('title', 'ورود')
@section('content')
@php
  use App\User;
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <p style="text-align: justify">
                  @if(session('auth.group') == User::G_PATIENT)
                    برای دریافت نوبت و استفاده از سایر امکانات دکترسوال باید ابتدا به حساب کاربری خود وارد شوید، یا یک حساب جدید بسازید
                  @endif
                  @if(session('auth.group') == User::G_DOCTOR)
                    برای استفاده از امکانات دکتر سوال نظیر، تعریف مطب، اختصاص منشی و فعالسازی نوبتگیری آنلاین برای مطب خود ابتدا باید به حساب کاربری خود وارد شوید یا یک حساب کاربری جدید بسازید.
                  @endif
                  @if(session('auth.group') == User::G_MANAGER)
                    برای استفاده از امکانات مدیریتی دکترسوال نظیر ساخت مرکز درمانی، مدیریت پزشکان اختصاص منشی و ارائه خدمات درمانی آنلاین باید به حساب کاربری خود وارد شوید یا یک حساب کاربری جدید بسازید.
                  @endif
                  @if(session('auth.group') == User::G_SECRETARY)
                    برای استفاده از خدمات دکترسوال نظیر مشاهده مطب ها، مدیریت نوبت ها و استعلام بیماران یا تغییر در زمان نوبت دهی پزشک خود باید به حساب خود وارد شوید یا یک حساب کاربری جدید بسازید.
                  @endif
                </p>
                <form class="login-form"method="GET" action="{{ route('send') }}">
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label text-md-right">{{ __('general.phone') }}</label>
                        <div class="col-md-8">
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-3" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">
                                {{ __('auth.send_sms') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 login-pic">
            <img src="{{url('/imgs/logo.png')}}" class="login-img">
        </div>
    </div>
</div>
@endsection
