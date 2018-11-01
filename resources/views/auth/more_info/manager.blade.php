@extends('layouts.app')
@section('title', 'ثبت نام مدیر')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <form class="login-form" method="POST" action="{{ route('create.manager') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="token" class="col-md-3 col-form-label text-md-right">{{ __('users.token') }}</label>
                        <div class="col-md-8">
                            <input id="token" type="text" class="form-control{{ ($errors->has('token') || session('register.token_mismatch', false)) ? ' is-invalid' : '' }}" name="token" value="{{ old('token') }}" required>
                            @if ($errors->has('token'))
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
                    <div class="form-group row mb-0" style="display: flex; justify-content: center;">
                        <button type="submit"class="btn btn-primary" style="margin: 10px">
                            {{ __('general.register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 login-pic">
            <img src="{{asset('/imgs/005-management.svg')}}" class="login-img">
        </div>
    </div>
</div>
@endsection
