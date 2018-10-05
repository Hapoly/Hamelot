@extends('layouts.main')
@section('title', __('users.edit.admin'))
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.edit.admin') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.profile.admin') }}" enctype="multipart/form-data">
                      @csrf
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
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
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
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
                        @submit_row(['value' => 'save', 'label' => __('users.save')])
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endsection
