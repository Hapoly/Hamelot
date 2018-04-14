@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('hospital_users.create') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.hospital_users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('hospital_users.user_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="user_id" id="user_id">
                                @foreach($users as $user)
                                  <option value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </option>
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
                          <label for="hospital_id" class="col-md-4 col-form-label text-md-right">{{ __('hospital_users.hospital_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="hospital_id" id="hospital_id">
                                @foreach($hospitals as $hospital)
                                  <option value="{{$hospital->id}}"> {{$hospital->title}} </option>
                                @endforeach
                              </select>
                              @if ($errors->has('hospital_id'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('hospital_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('hospital_users.status') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status" id="status">
                                    <option value="1">{{__('hospital_users.status_str.1')}}  </option>
                                    <option value="2">{{__('hospital_users.status_str.2')}}  </option>
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
                                    {{ __('hospital_users.save') }}
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
