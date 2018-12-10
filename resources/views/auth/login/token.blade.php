@extends('layouts.app')
@section('title', 'ورود')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="login-card">
                @if(session('resend') == '1')
                    <div class="alert alert-success" style="text-align: right" role="alert">
                        {{__('auth.resent')}}
                    </div>
                @endif
                <form class="login-form"method="POST" action="{{ route('check') }}">
                    @csrf
                    <p style="text-align: justify; direction: rtl;">{{__('auth.entered_phone', ['phone' => $phone])}}</p>
                    <div class="form-group row">
                        <label for="token" class="col-sm-3 col-form-label text-md-right">{{ __('auth.token') }}</label>
                        <div class="col-md-8">
                            <input id="token" type="text" class="form-control{{ ($errors->has('token') || session('register.token_mismatch')) ? ' is-invalid' : '' }}" name="token" value="{{ old('token') }}" autofocus>
                            @if (sizeof($errors->all())>0)
                                <span class="invalid-feedback" style="display: grid;">
                                    <strong>{{ $errors->first() }}</strong>
                                </span>
                            @endif
                            @if(session('failed'))
                                <span class="invalid-feedback" style="display: grid;">
                                    <strong>{{ __('auth.login_failed') }}</strong>
                                </span>
                                @php
                                    session()->forget('failed');
                                @endphp
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-12" style="text-align: center;">
                            <button type="submit" name="action" value="check" class="btn btn-primary">
                                {{ __('auth.check') }}
                            </button>
                            <a class="btn btn-default" href="{{route('send', ['phone' => session('auth.phone'), 'again' => true])}}">
                                {{ __('auth.resend') }}
                            </a>
                            <a class="btn btn-default" href="{{route('login', ['group' => session('auth.group')])}}">
                                {{ __('auth.change_phone') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <img src="{{url('/imgs/logo.png')}}" class="login-img">
        </div>
    </div>
</div>
@endsection
