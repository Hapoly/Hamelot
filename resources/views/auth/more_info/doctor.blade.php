@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <form class="login-form" method="POST" action="{{ route('create.doctor') }}" enctype="multipart/form-data">
                    @csrf
                    <input hidden name="username" value="{{$request->username}}" />
                    <input hidden name="password" value="{{$request->password}}" />
                    <input hidden name="first_name" value="{{$request->first_name}}" />
                    <input hidden name="last_name" value="{{$request->last_name}}" />
                    <input hidden name="group_code" value="{{$request->group_code}}" />
                    <div class="form-group row">
                        <label for="msc" class="col-md-3 col-form-label text-md-right">{{ __('users.msc') }}</label>

                        <div class="col-md-8">
                            <input id="msc" type="text" class="form-control{{ $errors->has('msc') ? ' is-invalid' : '' }}" name="msc" value="{{ old('msc') }}" required>

                            @if ($errors->has('msc'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('msc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="degree_id" class="col-md-3 col-form-label text-md-right">{{ __('users.degree') }}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="degree_id" id="degree_id">
                                @foreach($degrees as $degree)
                                    <option value="{{$degree->id}}" {{old('degree') == $degree->id? 'selected': ''}} > {{$degree->value}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('degree'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('degree') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="field_id" class="col-md-3 col-form-label text-md-right">{{ __('users.field') }}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="field_id" id="field_id">
                                @foreach($fields as $field)
                                    <option value="{{$field->id}}" {{old('field_id') == $field->id? 'selected': ''}} > {{$field->value}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('field_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('field_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-md-3 col-form-label text-md-right">{{ __('users.gender') }}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="gender" id="gender">
                                <option value="1" {{old('gender') == 1? 'selected': ''}} > {{__('users.gender_str.1')}}</option>
                                <option value="2" {{old('gender') == 2? 'selected': ''}} > {{__('users.gender_str.2')}}</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="public" class="col-md-3 col-form-label text-md-right">{{ __('users.public') }}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="public" id="public">
                                <option value="1" {{old('public') == 1? 'selected': ''}} > {{__('users.public_str.1')}}</option>
                                <option value="2" {{old('public') == 2? 'selected': ''}} > {{__('users.public_str.2')}}</option>
                            </select>
                            @if ($errors->has('public'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('public') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile" class="col-md-3 col-form-label text-md-right">{{ __('users.profile') }}</label>

                        <div class="col-md-8">
                            <input id="profile" type="file" class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}" name="profile" >

                            @if ($errors->has('profile'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('profile') }}</strong>
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
            <img src="{{asset('/imgs/004-doctor.svg')}}" class="login-img">
        </div>
    </div>
</div>
@endsection
