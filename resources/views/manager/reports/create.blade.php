@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('reports.create') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manager.reports.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="key_id" class="col-md-4 col-form-label text-md-right">{{ __('reports.key_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="key_id" id="key_id">
                                @foreach($keys as $key)
                                  <option value="{{$key->id}}"> {{$key->template->title}} > {{$key->title}} </option>
                                @endforeach
                              </select>
                              @if ($errors->has('key_id'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('key_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('reports.patient_id') }}</label>
                          <div class="col-md-6">
                              <select class="form-control" name="patient_id" id="patient_id">
                                @foreach($patients as $patient)
                                  <option value="{{$patient->id}}"> {{$patient->first_name}} {{$patient->last_name}} </option>
                                @endforeach
                              </select>
                              @if ($errors->has('patient_id'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('patient_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="hospital_id" class="col-md-4 col-form-label text-md-right">{{ __('reports.hospital_id') }}</label>
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
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('reports.value') }}</label>
                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ old('value') }}" required autofocus>
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" name="action" value="new" class="btn btn-primary">
                                    {{ __('reports.save') }}
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
