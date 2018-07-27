@extends('layouts.main')
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.create.nurse') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.store.nurse') }}" enctype="multipart/form-data">
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
                            <select class="form-control" name="degree" id="degree" style="width:90%">
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
                        <label for="degree" class="col-md-2 col-form-label text-center">{{ __('users.degree') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="field" id="field" style="width:90%">
                                @foreach($fields as $field)
                                    <option value="{{$field->id}}" {{old('field') == $field->id? 'selected': ''}} > {{$field->value}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('field'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('field') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="field" class="col-md-2 col-form-label text-center">{{ __('users.field') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="gender" id="gender" style="width:90%">
                                @foreach($genders as $gender)
                                    <option value="{{$gender->id}}" {{old('gender') == $gender->id? 'selected': ''}} > {{$gender->value}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('gender'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="gender" class="col-md-2 col-form-label text-center">{{ __('users.gender') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
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
                        <label for="status" class="col-md-2 col-form-label text-center">{{ __('users.status') }}</label>
                    </div>
                    
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="profile" type="file" class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}" name="profile">
                                 @if ($errors->has('profile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                                @endif
                        </div>
                         <label for="profile" class="col-md-2 col-form-label text-center">{{ __('users.profile') }}</label>
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
