@extends('layouts.app')
@section('title', 'ورود')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
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
