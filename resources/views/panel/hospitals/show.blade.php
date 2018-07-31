@extends('layouts.main')
@section('title', $hospital->title)
@section('content')
<?php
  use App\User;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $hospital->title }}</h2>
    </div>
    <div class="row">
      <img src="{{asset($hospital->image_url)}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('hospitals.title')}}</td>
            <td>{{$hospital->title}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.address')}}</td>
            <td>{{$hospital->address}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.phone')}}</td>
            <td>{{$hospital->phone}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.mobile')}}</td>
            <td>{{$hospital->mobile}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.status')}}</td>
            <td>{{$hospital->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if(Auth::user()->isAdmin())
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.hospitals.edit', ['hospital' => $hospital])}}" class="btn btn-primary" role="button">{{__('hospitals.edit')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.hospitals.destroy', ['hospital' => $hospital])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <h2>{{__('hospital_users.title')}}</h2>
    @if(Auth::user()->isAdmin())
      <a href="{{route('panel.departments.create', ['hospital_id' => $hospital->id])}}" class="btn add" style="float:left;margin-left:20px;">{{__('departments.create')}}
        <i class="fa fa-plus"></i>
      </a>
    @endif
    @if(sizeof($hospital->users))
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
          @foreach($hospital->users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                  <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
                  <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-info" role="button">{{__('users.edit.general')}}</a>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('hospital_users.not_found')}}
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <h2>{{__('departments.index_title')}}</h2>
    <a href="{{route('panel.departments.create', ['hospital_id' => $hospital->id])}}" class="btn add" style="float:left;margin-left:20px;">{{__('departments.create')}}
      <i class="fa fa-plus"></i>
    </a>
    @if(sizeof($hospital->departments))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('departments.row')}}</th>
            <th>{{__('departments.title')}}</th>
            <th>{{__('departments.status')}}</th>
            <th>{{__('departments.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($hospital->departments as $department)
            <tr>
              <td>{{$department->id}}</td>
              <td><a href="{{route('panel.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
              <td>{{$department->status_str()}}</td>
              <td>
                <form action="{{route('panel.departments.destroy', ['department' => $department])}}" style="display: inline" method="POST" class="trash-icon">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">{{__('departments.remove')}}</button>
                </form>
                <a class="btn btn-primary" href="{{route('panel.hospitals.edit', ['hospital' => $hospital])}}">{{ __('departments.edit') }}</a>
              </td>
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
