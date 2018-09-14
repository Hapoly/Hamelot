@extends('layouts.main')
@section('title', __('users.create.patient'))
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.create.patient') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.store.patient') }}" enctype="multipart/form-data">
                      @csrf
                    <div class="form-group row create-form">
                        <label for="title" class="col-md-2 label-col col-form-label text-center">{{ __('users.username') }}</label>
                        <div class="col-md-10">
                           <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row create-form">
                        <label for="password" class="col-md-2 label-col col-form-label text-center">{{ __('users.password') }}</label>
                        <div class="col-md-10">
                           <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group row create-form">
                        <label for="password-confirm" class="col-md-2 label-col col-form-label text-center">{{ __('users.confirm_password') }}</label>
                        <div class="col-md-10">
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
                        </div>
                    </div>

                     <div class="form-group row create-form">
                        <label for="first_name" class="col-md-2 label-col col-form-label text-center">{{ __('users.first_name') }}</label>
                        <div class="col-md-10">
                           <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
                                 @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group row create-form">
                        <label for="last_name" class="col-md-2 label-col col-form-label text-center">{{ __('users.last_name') }}</label>
                        <div class="col-md-10">
                           <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                                 @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                        </div> 
                    </div>

                    <div class="form-group row create-form">
                        <label for="title" class="col-md-2 label-col col-form-label text-center">{{ __('users.id_number') }}</label>
                        <div class="col-md-10">
                           <input id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" required autofocus>
                                @if ($errors->has('id_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row create-form">
                        <label for="birth_year" class="col-md-2 label-col col-form-label text-center">{{ __('users.birth.year') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="birth_year" id="birth_year" style="width:90%">
                                @for($i=1341; $i<1400; $i++)
                                    <option value="{{$i}}" {{old('birth_year') == $i? 'selected': ''}} > {{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birth_year'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_year') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                    </div>
                    <div class="form-group row create-form">
                        <label for="birth_month" class="col-md-2 label-col col-form-label text-center">{{ __('users.birth.month') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="birth_month" id="birth_month" style="width:90%">
                                @for($i=1; $i<12; $i++)
                                    <option value="{{$i}}" {{old('birth_month') == $i? 'selected': ''}} > {{ __('users.birth.month_str.' . $i) }}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birth_month'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_month') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                    </div>
                    <div class="form-group row create-form">
                        <label for="birth_day" class="col-md-2 label-col col-form-label text-center">{{ __('users.birth.day') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="birth_day" id="birth_day" style="width:90%">
                                @for($i=1; $i<31; $i++)
                                    <option value="{{$i}}" {{old('birth_day') == $i? 'selected': ''}} > {{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birth_day'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_day') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row create-form">
                        <label for="gender" class="col-md-2 label-col col-form-label text-center">{{ __('users.gender') }}</label>
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
                    </div>
                    
                    <div class="form-group row create-form">
                        <label for="status" class="col-md-2 label-col col-form-label text-center">{{ __('users.status') }}</label>
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
                    </div>

                    <div class="form-group row create-form">
                        <label for="unit_id" class="col-md-2 label-col col-form-label text-center">{{ __('users.patient_unit_id') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="unit_id" id="unit_id" style="width:90%">
                                @foreach(Auth::user()->units as $unit)
                                    <option value="{{$unit->id}}" {{old('unit_id') == $unit->id? 'selected': ''}} >{{$unit->title}} - {{$unit->hospital->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('unit_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('unit_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row create-form">
                            <label for="profile" class="col-md-2 label-col col-form-label text-center">{{ __('users.profile') }}</label>
                        <div class="col-md-10">
                           <input id="profile" type="file" class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}" name="profile">
                                 @if ($errors->has('profile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                                @endif
                        </div> 
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
