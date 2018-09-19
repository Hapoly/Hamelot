@extends('layouts.main')
@section('title', __('users.edit.patient'))
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.create.patient') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.update.patient', ['user'  => $user]) }}" enctype="multipart/form-data">
                      @csrf
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username', $user->username) }}" required autofocus>
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
                           <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
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
                           <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
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
                           <input id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number', $user->patient->id_number) }}" required autofocus>
                                @if ($errors->has('id_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                            @endif
                        </div>
                         <label for="title" class="col-md-2 col-form-label text-center">{{ __('users.id_number') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="birth_year" id="birth_year" style="width:90%">
                                @for($i=1341; $i<1400; $i++)
                                    <option value="{{$i}}" {{old('birth_year', $user->patient->birth_year) == $i? 'selected': ''}} > {{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birth_year'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_year') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="birth_year" class="col-md-2 col-form-label text-center">{{ __('users.birth.year') }}</label>
                    </div>
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="birth_month" id="birth_month" style="width:90%">
                                @for($i=1; $i<12; $i++)
                                    <option value="{{$i}}" {{old('birth_month', $user->patient->birth_month) == $i? 'selected': ''}} > {{ __('users.birth.month_str.' . $i) }}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birth_month'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_month') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="birth_month" class="col-md-2 col-form-label text-center">{{ __('users.birth.month') }}</label>
                    </div>
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="birth_day" id="birth_day" style="width:90%">
                                @for($i=1; $i<31; $i++)
                                    <option value="{{$i}}" {{old('birth_day', $user->patient->birth_day) == $i? 'selected': ''}} > {{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birth_day'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_day') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="birth_day" class="col-md-2 col-form-label text-center">{{ __('users.birth.day') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="gender" id="gender" style="width:90%">
                                <option value="1" {{old('gender', $user->patient->gender) == 1? 'selected': ''}} > {{__('users.gender_str.1')}}</option>
                                <option value="2" {{old('gender', $user->patient->gender) == 2? 'selected': ''}} > {{__('users.gender_str.2')}}</option>
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
                        @submit_row(['value' => 'save', 'label' => __('users.save')])
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endsection
