@extends('layouts.main')
@section('title', __('permissions.create'))
@section('content')
<div class="container">
  @if($result == 'not_found')
    <div class="alert alert-danger" role="alert">
      {{__('permissions.not_found')}}
    </div>
  @endif
  @if($result == 'found')
    <div class="alert alert-success" role="alert">
      {{__('permissions.found')}}
    </div>
  @endif
  @if($result == 'exists')
    <div class="alert alert-info" role="alert">
      {{__('permissions.exists')}}
    </div>
  @endif
  @form_create(['action' => route('panel.permissions.check'), 'title' => __('permissions.create')])
    @tagline{{__('permissions.form_info')}}@endtagline
    @input_text(['name' => 'id_number', 'value' => isset($id_number)? $id_number: '', 'label' => __('permissions.id_number'), 'required' => true])
    @submit_row(['value' => 'new', 'label' => __('permissions.save')])
  @endform_create
  @if($result == 'found' || $result == 'exists')
    <div class="panel panel-default">
      <div class="row">
        <img src="{{$patient->patient->profile_url}}" class="center" style="width: 25%">
      </div>
      <div class="row">
        <h2>{{ $patient->first_name_str }} {{ $patient->last_name_str }}</h2>
      </div>
      <div class="row">
        <table class="table table-striped">
          <tbody>
            <tr>
              <td>{{__('users.first_name')}}</td>
              <td>{{$patient->first_name_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.last_name')}}</td>
              <td>{{$patient->last_name_str}}</td>
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
      @if($result == 'found')
        <div class="row">
          <form action="{{route('panel.permissions.send', ['user' => $patient])}}" method="post">
            @csrf
            <div class="col-md-12" style="text-align: center">
              <button type="submit" class="btn btn-primary">{{__('permissions.confirm')}}</button>
            </div>
          </form>
        </div>
      @endif
    </div>
  @endif
</div>
@endsection
