@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="login-card">
                <form class="login-form" method="POST" action="{{ route('create.patient') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="id_number" class="col-md-3 col-form-label text-md-right">{{ __('users.id_number') }}</label>
                        <div class="col-md-8">
                            <input id="id_number" type="text" class="form-control {{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" required>

                            @if ($errors->has('id_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row create-form">
                        <label for="birth_date" class="col-md-3 col-form-label text-md-right">{{__('users.birth_date')}}</label>
                        <div class="col-md-8">
                            <input type="text" id="birth_date-v" value="{{old('birth_date')!=''?\App\Drivers\Time::jdate('Y/m/d H:i', old('birth_date')):''}}" class="form-control {{ $errors->has('birth-date') ? ' is-invalid' : '' }}"/>
                            <input hidden type="number" name="birth_date" id="birth_date" value="{{old('birth_date')}}"/>
                            @if ($errors->has('birth_date'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                                </span>
                            @endif

                        </div>
                        <script>
                            $("#birth_date-v").pDatepicker({
                                'altField'          : '#birth_date',
                                'format'            : 'YY/MM/DD',
                                'onlySelectOnDate'  : true,
                                'initialValue'      : false,
                            });
                        </script>
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
            <img src="{{asset('/imgs/008-patient.svg')}}" class="login-img">
        </div>
    </div>
</div>
@endsection
