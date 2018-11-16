@extends('layouts.main')
@section('title', __('users.create.admin'))
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.create.admin') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.store.admin') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row create-form">
                        <label for="phone" class="col-md-2 label-col col-form-label text-center">{{ __('users.phone') }}</label>
                        <div class="col-md-10">
                           <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                 @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                        </div> 
                    </div>
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
                        <label for="password_confirmation" class="col-md-2 label-col col-form-label text-center">{{ __('users.confirm_password') }}</label>
                        <div class="col-md-10">
                           <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required >
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
                        @submit_row(['value' => 'save', 'label' => __('users.save')])
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endsection
