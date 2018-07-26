@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('users.edit') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.users.update', ['user' => $user]) }}">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('users.username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username', $user->username) }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('users.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('users.confirm_password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('users.first_name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('users.last_name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prefix" class="col-md-4 col-form-label text-md-right">{{ __('users.prefix') }}</label>

                            <div class="col-md-6">
                                <input id="prefix" type="text" class="form-control{{ $errors->has('prefix') ? ' is-invalid' : '' }}" name="prefix" value="{{ old('prefix', $user->prefix) }}" required>

                                @if ($errors->has('prefix'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="group_code" class="col-md-4 col-form-label text-md-right">{{ __('users.group_code') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="group_code" id="group_code">
                                    <option value="1" {{old('group_code', $user->group_code) == 1? 'selected': ''}} >{{__('users.group_code_str.1')}}   </option>
                                    <option value="2" {{old('group_code', $user->group_code) == 2? 'selected': ''}} >{{__('users.group_code_str.2')}} </option>
                                    <option value="3" {{old('group_code', $user->group_code) == 3? 'selected': ''}} >{{__('users.group_code_str.3')}}  </option>
                                    <option value="4" {{old('group_code', $user->group_code) == 4? 'selected': ''}} >{{__('users.group_code_str.4')}}   </option>
                                    <option value="5" {{old('group_code', $user->group_code) == 5? 'selected': ''}} >{{__('users.group_code_str.5')}} </option>
                                </select>
                                @if ($errors->has('group_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('group_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('users.status') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" id="status">
                                    <option value="1" {{old('status', $user->status) == 1? 'selected': ''}} >{{__('users.status_str.1')}}  </option>
                                    <option value="2" {{old('status', $user->status) == 2? 'selected': ''}} >{{__('users.status_str.2')}}  </option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" name="action" value="edit" class="btn btn-primary">
                                    {{ __('users.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
