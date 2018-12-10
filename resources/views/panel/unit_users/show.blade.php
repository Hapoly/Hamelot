@extends('layouts.main')
@section('title', $hospital->title)
@section('content')
<?php
  use App\User;
  use App\Unit;
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
    <div class="panel-heading sub-panel-title">
      {{__('hospital_users.title')}}
      @if(Auth::user()->isAdmin())
        <a href="{{route('panel.units.create', ['hospital_id' => $hospital->id])}}" class="btn btn-primary sub-panel-add">{{__('units.create')}}</a>
      @endif
    </div>
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
              <td>{{$user->first_name_str}}</td>
              <td>{{$user->last_name_str}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                  <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.remove')}}</a>
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
          {{__('hospital_users.not_found')}}
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <div class="sub-panel-title panel-heading">
      @if($hospital->has_permission)
        <a href="{{route('panel.units.create', ['hospital_id' => $hospital->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('units.index_title')}}
    </div>
    @if(sizeof($hospital->units()))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('units.row')}}</th>
            <th>{{__('units.title')}}</th>
            <th>{{__('units.status')}}</th>
            @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
              <th>{{__('unit_users.join_status')}}</th>
            @endif
            <th>{{__('units.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($hospital->units as $unit)
            <tr>
              <td>{{$unit->id}}</td>
              <td><a href="{{route('panel.units.show', ['unit' => $unit])}}">{{$unit->title}}</a></td>
              <td>{{$unit->status_str}}</td>
              @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
                @if($unit->lastRequest())
                  <td>{{$unit->lastRequest()->status_str}}</td>
                @else
                  <td> - </td>
                @endif
              @endif
              <td>
                @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                    <form action="{{route('panel.units.destroy', ['unit' => $unit])}}" style="display: inline" method="POST" class="trash-icon">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">{{__('units.remove')}}</button>
                    </form>
                    <a class="btn btn-primary" href="{{route('panel.hospitals.edit', ['hospital' => $hospital])}}">{{ __('units.edit') }}</a>
                @elseif(Auth::user()->isDoctor() || Auth::user()->isNurse())
                  @if($unit->canJoin())
                    <a class="btn btn-primary" href="{{route('panel.unit_users.send', ['user' => Auth::user(), 'unit' => $unit])}}">{{ __('unit_users.send') }}</a>
                  @else
                    -
                  @endif
                @else
                  -
                @endif
              </td>
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
