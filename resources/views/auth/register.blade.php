@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <form class="login-form" method="GET" action="{{ route('more_info') }}">
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
                        <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('general.confirm_password') }}</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
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
                    <!-- <div class="form-group row">
                        <label for="prefix" class="col-md-3 col-form-label text-md-right">{{ __('general.prefix') }}</label>

                        <div class="col-md-8">
                            <input id="prefix" type="text" class="form-control{{ $errors->has('prefix') ? ' is-invalid' : '' }}" name="prefix" value="{{ old('prefix') }}" required>

                            @if ($errors->has('prefix'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('prefix') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <label for="group_code" class="col-md-3 col-form-label text-md-right">{{ __('general.group_code') }}</label>

                        <div class="col-md-8">
                            <select class="form-control" name="group_code" id="group_code">
                                <option value="1">{{__('general.group_codes.admin')}}   </option>
                                <option value="2">{{__('general.group_codes.manager')}} </option>
                                <option value="3">{{__('general.group_codes.doctor')}}  </option>
                                <option value="4">{{__('general.group_codes.nurse')}}   </option>
                                <option value="5">{{__('general.group_codes.patient')}} </option>
                            </select>
                            @if ($errors->has('group_code'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('group_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> -->
                   
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
            <img src="/imgs/logo.png" class="login-img">
        </div>
    </div>
</div>


@endsection
