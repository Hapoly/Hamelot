@extends('layouts.main')
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
        <h2>{{ __('patients.create') }}</h2>
             <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.patients.store') }}" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group row create-form">
                            <div class="col-md-10">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="first_name" class="col-md-2 col-form-label text-center">{{ __('patients.first_name') }}</label>
                        </div>
                        <div class="form-group row create-form">
                            <div class="col-md-10">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="last_name"class="col-md-2 col-form-label text-center">{{ __('patients.last_name') }}</label>
                        </div>
                        <div class="form-group row create-form">
                            <div class="col-md-10">
                                <input id="id_number" type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('id_number') }}" required autofocus>
                                @if ($errors->has('id_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('id_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="id_number"class="col-md-2 col-form-label text-center">{{ __('patients.id_number') }}</label>
                        </div>

                        <div class="form-group row create-form">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <div class="col-md-10">
                                    <select class="form-control" name="gender" id="gender" style="width:80%">
                                        <option value="1">{{__('patients.gender_str.1')}}  </option>
                                        <option value="2">{{__('patients.gender_str.2')}}  </option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <label  for="gender" class="col-md-2 col-form-label text-center">{{ __('patients.gender') }}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row" style="margin-right:10px;">
                                <div class="col-md-10">
                                    <select class="form-control" name="status" id="status" style="width:80%;">
                                    <option value="1">{{__('patients.status_str.1')}}  </option>
                                    <option value="2">{{__('patients.status_str.2')}}  </option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <label for="status" class="col-md-2 col-form-label text-center">{{ __('patients.status') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row create-form">
                            <div class="col-md-10">
                                <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="image" class="col-md-2 col-form-label text-center">{{ __('patients.image') }}</label>
                        </div>
                              
                        <button type="submit" name="action" value="new" class="btn btn-primary save-btn">
                            {{ __('patients.save') }}
                        </button>
 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
