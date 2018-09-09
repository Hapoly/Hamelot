@extends('layouts.main')
@section('title', $hospital->title)
@section('content')
<?php
  use App\User;
  use App\Department;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $hospital->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$hospital->image_url}}" class="center" style="width: 25%;">
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
            <td>{{$hospital->phone_str}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.mobile')}}</td>
            <td>{{$hospital->mobile_str}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.status')}}</td>
            <td>{{$hospital->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.city_id')}}</td>
            <td>{{$hospital->city->title}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if($hospital->has_permission)
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
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.hospitals.members', ['hospital' => $hospital])}}">{{__('hospitals.print_members')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.hospitals.departments', ['hospital' => $hospital])}}">{{__('hospitals.print_departments')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.hospitals.info', ['hospital' => $hospital])}}">{{__('hospitals.print_info')}}</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      {{__('hospital_users.title')}}
    </div>
    @if(sizeof($hospital->managers))
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
          @foreach($hospital->managers as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
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
    <div class="sub-panel-title panel-heading">
      @if($hospital->has_permission)
        <a href="{{route('panel.departments.create', ['hospital_id' => $hospital->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('departments.index_title')}}
    </div>
    @if(sizeof($hospital->departments()))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('departments.row')}}</th>
            <th>{{__('departments.title')}}</th>
            <th>{{__('departments.status')}}</th>
            @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
              <th>{{__('unit_users.join_status')}}</th>
            @endif
            <th>{{__('departments.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($hospital->departments as $department)
            <tr>
              <td>{{$department->id}}</td>
              <td><a href="{{route('panel.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
              <td>{{$department->status_str}}</td>
              @if($hospital->has_permission)
                @operation_th(['base' => 'panel.departments', 'label' => 'department', 'item' => $department, 'remove_label' => __('departments.remove'), 'edit_label' => __('departments.edit'), 'show_label' => __('departments.show')])
              @elseif(Auth::user()->isDoctor() || Auth::user()->isNurse())
                @if($department->canJoin())
                  <td><a class="btn btn-primary" href="{{route('panel.unit_users.send_department', ['user' => Auth::user(), 'department' => $department])}}">{{ __('unit_users.send') }}</a></td>
                @else
                  <td>-</td>
                @endif
              @else
                <td>-</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('unit_users.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
