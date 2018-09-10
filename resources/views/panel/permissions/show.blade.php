@extends('layouts.main')
@section('title', $permission->patient->full_name)
@section('content')
<?php
  use App\User;
?>
<div class="container">
  <div class="panel panel-default">
    @if(Auth::user()->isPatient() || Auth::user()->isDoctor() || Auth::user()->isNurse())
      <div class="row">
        <img src="{{$permission->patient->patient->profile_url}}" class="center" style="width: 25%">
      </div>
    @endif
    <div class="row">
      @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
        <h3>{{ $permission->patient->first_name }} {{ $permission->patient->last_name }}</h3>
      @elseif(Auth::user()->isPatient())
        <h3>{{ $permission->requester->first_name }} {{ $permission->requester->last_name }} ({{$permission->requester->group_str}})</h3>
      @endif
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody> 
          @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
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
          @elseif(Auth::user()->isPatient())
            <tr>
              <td>{{__('users.first_name')}}</td>
              <td>{{$permission->requester->first_name}}</td>
            </tr>
            <tr>
              <td>{{__('users.last_name')}}</td>
              <td>{{$permission->requester->last_name}}</td>
            </tr>
            <tr>
              <td>{{__('users.status')}}</td>
              <td>{{$permission->requester->status_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.field')}}</td>
              <td>{{$permission->requester->field_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.degree')}}</td>
              <td>{{$permission->requester->degree_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.msc')}}</td>
              <td>{{$permission->requester->msc_str}}</td>
            </tr>
          @else
            <tr>
              <th></th>
              <th>{{__('permissions.requester_id')}}</th>
              <th>{{__('permissions.patient_id')}}</th>
            </tr>
            <tr>
              <td>{{__('users.first_name')}}</td>
              <td>{{$permission->requester->first_name}}</td>
              <td>{{$permission->patient->first_name}}</td>
            </tr>
            <tr>
              <td>{{__('users.last_name')}}</td>
              <td>{{$permission->requester->last_name}}</td>
              <td>{{$permission->patient->last_name}}</td>
            </tr>
            <tr>
              <td>{{__('users.status')}}</td>
              <td>{{$permission->requester->status_str}}</td>
              <td>{{$permission->patient->status_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.field')}}</td>
              <td>{{$permission->requester->field_str}}</td>
              <td>{{$permission->patient->field_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.degree')}}</td>
              <td>{{$permission->requester->degree_str}}</td>
              <td>{{$permission->patient->degree_str}}</td>
            </tr>
            <tr>
              <td>{{__('users.msc')}}</td>
              <td>{{$permission->requester->msc_str}}</td>
              <td>{{$permission->patient->msc_str}}</td>
            </tr>
          @endif
          <tr>
              <td>{{__('users.status')}}</td>
              <td colspan="2">{{$permission->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if($permission->edit_access)
    <div class="row">
      <form action="{{route('panel.permissions.inline_update', ['permission' => $permission])}}" method="post">
        @csrf
        <div class="col-md-12" style="text-align: center">
          @if(Auth::user()->isAdmin() || Auth::user()->id == $permission->patient_id)
            @if($permission->pending())
              <button type="submit" name="action" value="accept" class="btn btn-primary">{{__('permissions.accept')}}</button>
              <button type="submit" name="action" value="refuse" class="btn btn-danger">{{__('permissions.refuse')}}</button>
            @elseif($permission->accepted())
              <button type="submit" name="action" value="cancel" class="btn btn-warning">{{__('permissions.cancel')}}</button>
            @endif
          @endif
          @if(Auth::user()->isAdmin() || Auth::user()->id == $permission->requester_id)
            @if(!$permission->canceled())
              <button type="submit" name="action" value="cancel" class="btn btn-warning">{{__('permissions.cancel')}}</button>
            @endif
          @endif
          @if($permission->accepted() && !Auth::user()->isPatient())
            <a href="{{route('panel.users.show', ['user' => $permission->patient])}}" class="btn btn-info">{{__('permissions.show_profile')}}</a>
          @endif
        </div>
      </form>
    </div>
    @endif
  </div>
</div>
@endsection
