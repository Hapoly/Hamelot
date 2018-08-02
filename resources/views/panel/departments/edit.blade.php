@extends('layouts.main')
@section('title', __('departments.edit'))
@section('content')
<div class="container">
  <div class="panel panel-default">
    <h2>{{ __('departments.edit') }}</h2>
    <div class="row">
      <div class="col-md-12">
      <form method="POST" action="{{ route('panel.departments.update', ['department' => $department]) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @csrf
        <div class="form-group row">
          <div class="col-md-10">
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $department->title) }}" required autofocus>
            @if ($errors->has('title'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <label for="title" class="col-md-2 col-form-label text-center">{{ __('departments.title') }}</label>
        </div>
        <div class="form-group row">
          <div class="col-md-10">
            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description', $department->description) }}" required autofocus>
            @if ($errors->has('description'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
            @endif
          </div>
          <label for="description" class="col-md-2 col-form-label text-center">{{ __('departments.description') }}</label>
        </div>
        <div class="form-group row">
          <div class="col-md-10">
            <select class="form-control" name="hospital_id" id="hospital_id" style="width: 90%;">
              @foreach($hospitals as $hospital)
                <option value="{{$hospital->id}}" {{old('hospital_id', $department->hospital->id) == $hospital->id? 'selected': ''}}>{{$hospital->title}}</option>
              @endforeach
            </select>
            @if ($errors->has('hospital_id'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('hospital_id') }}</strong>
              </span>
            @endif
          </div>
          <label for="hospital_id" class="col-md-2 col-form-label text-center">{{ __('departments.hospital_id') }}</label>
        </div>
        <div class="form-group row">
          <div class="col-md-10">
            <select class="form-control" name="status" id="status" style="width: 90%;">
              <option value="1" {{(old('status', $department->status) == 1? 'selected': '')}} >{{__('departments.status_str.1')}}  </option>
              <option value="2" {{(old('status', $department->status) == 2? 'selected': '')}} >{{__('departments.status_str.2')}}  </option>
            </select>
            @if ($errors->has('status'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('status') }}</strong>
              </span>
            @endif
          </div>
          <label for="status" class="col-md-2 col-form-label text-center">{{ __('departments.status') }}</label>
        </div>
        @submit(['value' => 'edit'])
        {{ __('departments.edit') }}
        @endsubmit
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
