@extends('layouts.main')
@section('title', $policlinic->title)
@section('content')
<?php
  use App\User;
  use App\Department;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $policlinic->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$policlinic->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('policlinics.title')}}</td>
            <td>{{$policlinic->title}}</td>
          </tr>
          <tr>
            <td>{{__('policlinics.address')}}</td>
            <td>{{$policlinic->address}}</td>
          </tr>
          <tr>
            <td>{{__('policlinics.phone')}}</td>
            <td>{{$policlinic->phone_str}}</td>
          </tr>
          <tr>
            <td>{{__('policlinics.mobile')}}</td>
            <td>{{$policlinic->mobile_str}}</td>
          </tr>
          <tr>
            <td>{{__('policlinics.status')}}</td>
            <td>{{$policlinic->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('policlinics.city_id')}}</td>
            <td>{{$policlinic->city->title}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if($policlinic->has_permission)
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.policlinics.edit', ['policlinic' => $policlinic])}}" class="btn btn-primary" role="button">{{__('policlinics.edit')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.policlinics.destroy', ['policlinic' => $policlinic])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      {{__('department_users.title')}}
    </div>
    @if(sizeof($policlinic->users))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('users.row')}}</th>
            <th>{{__('users.first_name')}}</th>
            <th>{{__('users.last_name')}}</th>
            <th>{{__('users.status')}}</th>
            @if(Auth::user()->isAdmin())
              <th>{{__('users.operation')}}</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach($policlinic->users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                  <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
                  <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-info" role="button">{{__('users.edit.general')}}</a>
                  <a href="{{route('panel.users.show', ['user' => $user])}}" class="btn btn-info" role="button">{{__('users.show')}}</a>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('department_users.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
