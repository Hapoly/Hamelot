@extends('layouts.main')
@section('title', __('permissions.create'))
@section('content')
<div class="container">
  @if($result == 'not_found')
    <div class="alert alert-danger" role="alert" style="margin-left: 15px; margin-right: 15px;">
      {{__('permissions.not_found')}}
    </div>
  @endif
  @form_create(['action' => route('panel.permissions.check'), 'title' => __('permissions.create')])
    @input_text(['name' => 'id_number', 'value' => isset($id_number)? $id_number: '', 'label' => __('permissions.id_number'), 'required' => true])
    @submit_row(['value' => 'new', 'label' => __('permissions.save')])
  @endform_create
  @if($result == 'found')
    <div class="panel panel-default">
      <div class="row">
        <img src="{{$patient->patient->profile_url}}" class="center" style="width: 25%">
      </div>
      <div class="row">
        <h2>{{ $patient->first_name }} {{ $patient->last_name }}</h2>
      </div>
      <div class="row">
        <table class="table table-striped">
          <tbody>
            <tr>
              <td>{{__('users.first_name')}}</td>
              <td>{{$patient->first_name}}</td>
            </tr>
            <tr>
              <td>{{__('users.last_name')}}</td>
              <td>{{$patient->last_name}}</td>
            </tr>
            <tr>
              <td>{{__('users.status')}}</td>
              <td>{{$patient->status_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.gender')}}</td>
              <td>{{$patient->patient->gender_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.birth_date')}}</td>
              <td>{{$patient->patient->birth_date_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.age')}}</td>
              <td>{{$patient->patient->age_str}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      @if(Auth::user()->isAdmin())
        <div class="row">
          <div class="col-md-6" style="text-align: center">
            <a href="{{route('panel.users.edit', ['user' => $patient])}}" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
            @if(Auth::user()->isDoctor())
              <a href="{{route('panel.permissions.create', ['user' => $patient])}}" class="btn btn-primary" role="button">{{__('permissions.create')}}</a>
            @endif
          </div>
          <div class="col-md-6" style="text-align: center">
            <a href="{{route('panel.users.destroy', ['user' => $patient])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
          </div>
        </div>
      @endif
    </div>
  @endif
</div>
@endsection
