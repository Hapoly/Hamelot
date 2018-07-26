@extends('layouts.main')
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.create.patient') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.store') }}" enctype="multipart/form-data">
                      @csrf
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                         <label for="title" class="col-md-2 col-form-label text-center">{{ __('users.username') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                         <label for="password" class="col-md-2 col-form-label text-center">{{ __('users.password') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
                        </div>
                         <label for="password-confirm" class="col-md-2 col-form-label text-center">{{ __('users.confirm_password') }}</label>
                    </div>

                     <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
                                 @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                         <label for="first_name" class="col-md-2 col-form-label text-center">{{ __('users.first_name') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                                 @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                         <label for="last_name" class="col-md-2 col-form-label text-center">{{ __('users.last_name') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="prefix" type="text" class="form-control{{ $errors->has('prefix') ? ' is-invalid' : '' }}" name="prefix" value="{{ old('prefix') }}"  required>
                                 @if ($errors->has('prefix'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                @endif
                        </div>
                         <label for="prefix" class="col-md-2 col-form-label text-center"> {{ __('users.prefix') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <select class="form-control" name="group_code" id="group_code" style="width:80%;">
                                            <option value="1">{{__('users.group_code_str.1')}}   </option>
                                            <option value="2">{{__('users.group_code_str.2')}} </option>
                                            <option value="3">{{__('users.group_code_str.3')}}  </option>
                                            <option value="4">{{__('users.group_code_str.4')}}   </option>
                                            <option value="5">{{__('users.group_code_str.5')}} </option>
                                        </select>
                                        @if ($errors->has('group_code'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('group_code') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <label for="group_code" class="col-md-4 col-form-label text-center">{{ __('users.group_code') }}</label>
                            </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group row" style="margin-right:1px;">
                                <div class="col-md-8">
                                    <select class="form-control" name="status" id="status" style="width:90%">
                                        <option value="1">{{__('users.status_str.1')}}  </option>
                                        <option value="2">{{__('users.status_str.2')}}  </option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label for="status" class="col-md-4 col-form-label text-center">{{ __('users.status') }}</label>
                         </div>
                    </div>

                        <button type="submit" name="action" value="new" class="btn btn-primary save-btn">
                            {{ __('users.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endsection
