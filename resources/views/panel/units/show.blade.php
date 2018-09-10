@extends('layouts.main')
@section('title', $unit->title)
@section('content')
<?php
  use App\User;
  use App\Department;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $unit->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$unit->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('units.title')}}</td>
            <td>{{$unit->title}}</td>
          </tr>
          <tr>
            <td>{{__('units.address')}}</td>
            <td>{{$unit->address}}</td>
          </tr>
          <tr>
            <td>{{__('units.phone')}}</td>
            <td>{{$unit->phone_str}}</td>
          </tr>
          <tr>
            <td>{{__('units.mobile')}}</td>
            <td>{{$unit->mobile_str}}</td>
          </tr>
          <tr>
            <td>{{__('units.status')}}</td>
            <td>{{$unit->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('units.city_id')}}</td>
            <td>{{$unit->city->title}}</td>
          </tr>
          @if(!(Auth::user()->isAdmin() || Auth::user()->isPatient()))
            <tr>
              <td>{{__('units.joined_status')}}</td>
              <td>{{$unit->joined_status_str}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    @if($unit->has_permission)
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.units.edit', ['unit' => $unit])}}" class="btn btn-primary" role="button">{{__('units.edit')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.units.destroy', ['unit' => $unit])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>
    @endif
    @if($unit->can_join)
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-primary" href="{{route('panel.unit_users.send', ['unit' => $unit])}}">{{__('unit_users.send')}}</a>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.units.members', ['unit' => $unit])}}">{{__('units.print_members')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.units.sub_units', ['unit' => $unit])}}">{{__('units.print_sub_units')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.units.info', ['unit' => $unit])}}">{{__('units.print_info')}}</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      @if($unit->has_permission)
        <a href="{{route('panel.unit_users.create.manager', ['unit_id' => $unit->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('unit_users.managers')}}
    </div>
    @if(sizeof($unit->managers))
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
          @foreach($unit->managers as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
                </td>
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
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      @if($unit->has_permission)
        <a href="{{route('panel.unit_users.create.member', ['unit_id' => $unit->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('unit_users.members')}}
    </div>
    @if(sizeof($unit->members))
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
          @foreach($unit->members as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                  @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
                  <a class="btn btn-warning" href="{{route('panel.unit_users.inline_update', ['unit_user' => $user->pivot->id, 'action' => 'cancel'])}}">{{__('unit_users.cancel')}}</a>
                </td>
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
  <div class="panel panel-default">
    <div class="sub-panel-title panel-heading">
      @if($unit->has_permission)
        <a href="{{route('panel.units.create', ['unit_id' => $unit->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('units.index_title')}}
    </div>
    @if(sizeof($unit->sub_units))
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
          @foreach($unit->sub_units as $sub_unit)
            <tr>
              <td>{{$sub_unit->id}}</td>
              <td><a href="{{route('panel.units.show', ['unit' => $sub_unit])}}">{{$sub_unit->title}}</a></td>
              <td>{{$sub_unit->status_str}}</td>
              @if($unit->has_permission)
                <td>
                  @operation_th(['base' => 'panel.units', 'label' => 'unit', 'item' => $sub_unit, 'remove_label' => __('units.remove'), 'edit_label' => __('units.edit'), 'show_label' => __('units.show')])
                </td>
              @elseif(Auth::user()->isDoctor() || Auth::user()->isNurse())
                @if($sub_unit->canJoin())
                  <td><a class="btn btn-primary" href="{{route('panel.unit_users.send', ['user' => Auth::user(), 'unit' => $sub_unit])}}">{{ __('unit_users.send') }}</a></td>
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
