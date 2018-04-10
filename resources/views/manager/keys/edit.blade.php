@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('keys.edit') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('keys.update', ['key' => $key]) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('keys.title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $key->title) }}" required autofocus>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('keys.description') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description', $key->description) }}" required>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="template_id" class="col-md-4 col-form-label text-md-right">{{ __('keys.template_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="template_id" id="template_id">
                                @foreach($templates as $template)
                                  <option value="{{$template->id}}" {{old('template_id', $key->template->id) == $template->id? 'selected' : ''}}> {{$template->title}} </option>
                                @endforeach
                              </select>
                              @if ($errors->has('template_id'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('template_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('keys.type') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="type" id="type">
                                    <option value="1" {{old('type', $key->type) == 1? 'selected' : ''}} >{{__('keys.type_str.1')}}  </option>
                                    <option value="2" {{old('type', $key->type) == 2? 'selected' : ''}} >{{__('keys.type_str.2')}}  </option>
                                    <option value="3" {{old('type', $key->type) == 3? 'selected' : ''}} >{{__('keys.type_str.3')}}  </option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('keys.status') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" id="status">
                                    <option value="1" {{old('status', $key->status) == 1? 'selected' : ''}} >{{__('keys.status_str.1')}}  </option>
                                    <option value="2" {{old('status', $key->status) == 1? 'selected' : ''}} >{{__('keys.status_str.2')}}  </option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" name="action" value="new" class="btn btn-primary">
                                    {{ __('keys.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
