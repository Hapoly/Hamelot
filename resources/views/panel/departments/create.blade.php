@extends('layouts.main')
@section('content')
<div class="container">
  <div class="panel panel-default create-form">
    <h2>{{ __('departments.create') }}</h2>
    <div class="row">
      <div class="col-md-12">
      <form method="POST" action="{{ route('panel.departments.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
            @if ($errors->has('title'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <label for="title" class="col-md-2 col-form-label text-center">{{ __('departments.title') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>
            @if ($errors->has('description'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
            @endif
          </div>
          <label for="description" class="col-md-2 col-form-label text-center">{{ __('departments.description') }}</label>
        </div>
        <div class="form-group row create-form">
          <div class="col-md-10">
            <select class="form-control" name="hospital_id" id="hospital_id" style="width:93%">
              @foreach($hospitals as $hospital)
                <option value="{{$hospital->id}}" {{old('hospital_id') == $hospital->id? 'selected': ''}}>{{$hospital->title}}</option>
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
        <div class="form-group row create-form">
          <div class="col-md-10">
            <select class="form-control" name="status" id="status" style="width:93%">
              <option value="1">{{__('departments.status_str.1')}}  </option>
              <option value="2">{{__('departments.status_str.2')}}  </option>
            </select>
            @if ($errors->has('status'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('status') }}</strong>
              </span>
            @endif
          </div>
          <label for="status" class="col-md-2 col-form-label text-center">{{ __('departments.status') }}</label>
        </div>

      
            <button type="submit" name="action" value="new" class="btn btn-primary save-btn" >
              {{ __('departments.save') }}
            </button>
          
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
