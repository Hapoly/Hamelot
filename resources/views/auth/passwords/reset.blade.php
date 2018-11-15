@extends('layouts.app')
@section('title', 'بازسازی کلمه عبور')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <form class="login-form"method="POST" action="{{ route('forgot.password.reset') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="token" class="col-sm-3 col-form-label text-md-right">{{ __('auth.token') }}</label>
                        <div class="col-md-8">
                            <input id="token" type="text" class="form-control{{ ($errors->has('token') || session('register.token_mismatch')) ? ' is-invalid' : '' }}" name="token" value="{{ old('token') }}" required autofocus>
                            @if (($errors->has('token')))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('token') }}</strong>
                                </span>
                            @endif
                            @if (session('register.token_mismatch', false))
                                <span class="invalid-feedback">
                                    <strong>{{ __('validation.token_mismatch') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label text-md-right">{{ __('auth.password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-3 col-form-label text-md-right">{{ __('auth.password_confirmation') }}</label>

                        <div class="col-md-8">
                            <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" required autofocus>

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-12" style="text-align: center;">
                            <button type="submit" name="action" value="reset" class="btn btn-primary">
                                {{ __('auth.reset') }}
                            </button>
                            <button type="submit" name="action" value="resend" class="btn btn-primary">
                                {{ __('auth.resend') }}
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
