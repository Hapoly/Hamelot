@extends('layouts.app')
@section('title', 'ورود')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                @if(session('password_changed', false))
                    <div class="alert alert-success" style="text-align: right" role="alert">
                        {{__('auth.password_changed')}}
                    </div>
                @endif
                <form class="login-form"method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label text-md-right">{{ __('general.username') }}</label>

                        <div class="col-md-8">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('general.password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('general.remember_me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                            <div class="col-md-3" style="text-align: center;">
                                <button type="submit" class="btn btn-primary" id="login">
                                    {{ __('general.login') }}
                                </button>
                            </div>
                            <div class="col-md-8">
                                <a class="btn btn-link" href="{{ route('forgot.password') }}">
                                    {{ __('auth.forgot_password') }}
                                </a>
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
