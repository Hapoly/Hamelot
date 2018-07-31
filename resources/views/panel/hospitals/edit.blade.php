@extends('layouts.main')
@section('content')
<div class="container">
  <div class="panel panel-default create-form">
    <h2>{{ __('hospitals.edit') }}</h2>
    <div class="row">
      <div class="col-md-12">
      <form method="POST" action="{{ route('panel.hospitals.update', ['hospital' => $hospital]) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @csrf
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $hospital->title) }}" required autofocus>
            @if ($errors->has('title'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <label for="title" class="col-md-2 col-form-label text-center">{{ __('hospitals.title') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address', $hospital->address) }}" required autofocus>
            @if ($errors->has('address'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
              </span>
            @endif
          </div>
          <label for="address" class="col-md-2 col-form-label text-center">{{ __('hospitals.address') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', $hospital->phone) }}" required autofocus>
            @if ($errors->has('phone'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
              </span>
            @endif
          </div>
          <label for="phone" class="col-md-2 col-form-label text-center">{{ __('hospitals.phone') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile', $hospital->mobile) }}" required autofocus>
            @if ($errors->has('mobile'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('mobile') }}</strong>
              </span>
            @endif
          </div>
          <label for="mobile" class="col-md-2 col-form-label text-center">{{ __('hospitals.mobile') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
            @if ($errors->has('image'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('image') }}</strong>
              </span>
            @endif
          </div>
          <label for="image" class="col-md-2 col-form-label text-center">{{ __('hospitals.image') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <select class="form-control" name="status" id="status" style="width: 90%">
              <option value="1" {{old('status', $hospital->status) == 1? 'selected': ''}} >{{__('hospitals.status_str.1')}}  </option>
              <option value="2" {{old('status', $hospital->status) == 2? 'selected': ''}} >{{__('hospitals.status_str.2')}}  </option>
            </select>
            @if ($errors->has('status'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('status') }}</strong>
              </span>
            @endif
          </div>
          <label for="status" class="col-md-2 col-form-label text-center">{{ __('hospitals.status') }}</label>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-12" style="text-align: center">
            <button type="submit" name="action" value="edit" class="btn btn-primary">
              {{ __('hospitals.edit') }}
            </button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
