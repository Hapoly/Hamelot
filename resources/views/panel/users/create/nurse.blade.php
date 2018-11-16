@extends('layouts.main')
@section('title', __('users.create.nurse'))
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
         <h2>{{ __('users.create.nurse') }}</h2>
         <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.store.nurse') }}" enctype="multipart/form-data">
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
                        <label for="degree_id" class="col-md-2 label-col col-form-label text-center">{{ __('users.degree') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="degree_id" id="degree_id" style="width:90%">
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

                    <div class="form-group row create-form">
                        <label for="field_id" class="col-md-2 label-col col-form-label text-center">{{ __('users.field') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="field_id" id="field_id" style="width:90%">
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
                    </div>

                    <div class="form-group row create-form">
                        <label for="gender" class="col-md-2 label-col col-form-label text-center">{{ __('users.gender') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" name="gender" id="gender" style="width:90%">
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
                    
                    <div class="form-group row create-form">
                        <div class="col-md-10">
                           <input id="msc" type="text" class="form-control{{ $errors->has('msc') ? ' is-invalid' : '' }}" name="msc" value="{{ old('msc') }}" required autofocus>
                                @if ($errors->has('msc'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('msc') }}</strong>
                                </span>
                            @endif
                        </div>
                         <label for="title" class="col-md-2 col-form-label text-center">{{ __('users.msc') }}</label>
                    </div>

                    <div class="form-group row create-form">
                        <div class="col-md-10">
                            <select class="form-control" name="public" id="public" style="width:90%">
                                <option value="1" {{old('public') == 1? 'selected': ''}} >{{__('users.public_str.1')}}  </option>
                                <option value="2" {{old('public') == 2? 'selected': ''}} >{{__('users.public_str.2')}}  </option>
                            </select>
                            @if ($errors->has('public'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('public') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="status" class="col-md-2 col-form-label text-center">{{ __('users.public') }}</label>
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

                    <?php
                        $public_rows = [
                        [ 'value' => 1, 'label' => __('users.public_str.1') ],
                        [ 'value' => 2, 'label' => __('users.public_str.2') ],
                        ];
                    ?>
                    @input_select(['name' => 'public', 'value' => old('public', ''), 'label' => __('users.public'), 'required' => true, 'rows' => $public_rows])
                    
                    @submit_row(['value' => 'save', 'label' => __('users.save')])
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
@endsection
