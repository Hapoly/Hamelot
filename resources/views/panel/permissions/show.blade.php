@extends('layouts.main')
@section('title', $permission->patient->full_name)
@section('content')
<?php
  use App\User;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$permission->patient->patient->profile_url}}" class="center" style="width: 25%">
    </div>
    <div class="row">
      <h2>{{ $permission->patient->first_name }} {{ $permission->patient->last_name }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('users.first_name')}}</td>
            <td>{{$permission->patient->first_name}}</td>
          </tr>
          <tr>
            <td>{{__('users.last_name')}}</td>
            <td>{{$permission->patient->last_name}}</td>
          </tr>
          <tr>
            <td>{{__('users.id_number')}}</td>
            <td>{{$permission->patient->patient->id_number}}</td>
          </tr>
          <tr>
            <td>{{__('users.status')}}</td>
            <td>{{$permission->patient->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.gender')}}</td>
            <td>{{$permission->patient->patient->gender_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.birth_date')}}</td>
            <td>{{$permission->patient->patient->birth_date_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.age')}}</td>
            <td>{{$permission->patient->patient->age_str}}</td>
          </tr>
          <tr>
            <td>{{__('permissions.status')}}</td>
            <td>{{$permission->status_str_with_date}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <form action="{{route('panel.permissions.inline_update', ['permission' => $permission])}}" method="post">
        {{csrf_field()}}
        <div class="col-md-12" style="text-align: center">
          @if(Auth::user()->isAdmin() || Auth::user()->id == $permission->patient_id)
            @if($permission->pending())
              <button type="submit" name="action" value="accept" class="btn btn-primary">{{__('permissions.accept')}}</button>
              <button type="submit" name="action" value="refuse" class="btn btn-danger">{{__('permissions.refuse')}}</button>
            @elsif($permission->accepted())
              <button type="submit" name="action" value="cancel" class="btn btn-warning">{{__('permissions.cancel')}}</button>
            @endif
          @endif
          @if(Auth::user()->isAdmin() || Auth::user()->id == $permission->requester_id)
            @if(!$permission->canceled())
              <button type="submit" name="action" value="cancel" class="btn btn-warning">{{__('permissions.cancel')}}</button>
            @endif
          @endif
          @if($permission->accepted() && !Auth::user()->isPatient())
            <a href="{{route('panel.permissions.show_profile', ['user' => $permission->patient])}}" class="btn btn-info">{{__('permissions.show_profile')}}</a>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
