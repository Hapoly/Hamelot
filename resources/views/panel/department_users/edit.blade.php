@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('department_users.edit') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('panel.department_users.update', ['department_user' => $department_user]) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row">
                          <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('department_users.user_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="user_id" id="user_id">
                                @foreach($users as $user)
                                  <option value="{{$user->id}}" {{old('user_id', $department_user->user_id) == $user->id? 'selected': ''}} > {{$user->first_name}} {{$user->last_name}} </option>
                                @endforeach
                              </select>
                              @if ($errors->has('user_id'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('user_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="department_id" class="col-md-4 col-form-label text-md-right">{{ __('department_users.department_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="department_id" id="department_id">
                                @foreach($departments as $department)
                                  <option value="{{$department->id}}" {{old('department_id', $department_user->department_id) == $department->id? 'selected': ''}} > {{$department->title}} </option>
                                @endforeach
                              </select>
                              @if ($errors->has('department_id'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('department_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('department_users.status') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" id="status">
                                    <option value="1">{{__('department_users.status_str.1')}}  </option>
                                    <option value="2">{{__('department_users.status_str.2')}}  </option>
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
                                    {{ __('department_users.save') }}
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
