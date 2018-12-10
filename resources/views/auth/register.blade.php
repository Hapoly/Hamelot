@extends('layouts.app')
@section('title', 'ثبت نام')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <form class="login-form" method="GET" action="{{ route('more_info') }}">
                    <div class="form-group row">
                        <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('general.phone') }}</label>
                        <div class="col-md-8">
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-3 col-form-label text-md-right">{{ __('general.first_name') }}</label>

                        <div class="col-md-8">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>

                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-3 col-form-label text-md-right">{{ __('general.last_name') }}</label>

                        <div class="col-md-8">
                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('general.email') }}</label>
                        <div class="col-md-8">
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{__('general.optional')}}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0" style="display: flex; justify-content: center;">
                        <button type="submit" name="group_code" value="2" class="btn btn-primary" style="margin: 10px">
                            {{ __('general.register_as_manager') }}
                        </button>
                        <button type="submit" name="group_code" value="3" class="btn btn-primary" style="margin: 10px" >
                            {{ __('general.register_as_doctor') }}
                        </button>
                        <button type="submit" name="group_code" value="4" class="btn btn-primary" style="margin: 10px" >
                            {{ __('general.register_as_nurse') }}
                        </button>
                        <button type="submit" name="group_code" value="5" class="btn btn-primary" style="margin: 10px" >
                            {{ __('general.register_as_patient') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 login-pic">
            <img src="{{asset('/imgs/logo.png')}}" class="login-img">
        </div>
    </div>
</div>


@endsection
