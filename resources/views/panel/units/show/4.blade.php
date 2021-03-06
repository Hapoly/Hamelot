@extends('layouts.main')
@section('title', $unit->title)
@section('content')
<?php
  use App\User;
  use App\Unit;
?>
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{session()->get('success')}}
    </div>
  @endif
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
            <td>{{__('units.doctor.full_name')}}</td>
            <td>{{$unit->managers[0]->full_name}}</td>
          </tr>
          <tr>
            <td>{{__('units.doctor.fields')}}</td>
            <td>{{$unit->managers[0]->fields_str}}</td>
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
            <td>{{__('units.city_id')}}</td>
            <td>{{$unit->city->title}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      @if(Auth::user()->can('update', $unit))
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.units.edit', ['unit' => $unit])}}" class="btn btn-primary" role="button">{{__('units.edit')}}</a>
        </div>
      @endif
      @if(Auth::user()->can('destroy', $unit))
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.units.destroy', ['unit' => $unit])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      @endif
    </div>
    @if(Auth::user()->can('create_demand', $unit))
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          <a class="btn btn-default" href="{{route('unit', ['key' => $unit->slug])}}">{{__('demands.create_visit')}}</a>
        </div>
      </div>
    @endif
  </div>
  @if(Auth::user()->can('see_secretaries', $unit))
    <div class="panel panel-default">
      <div class="panel-heading sub-panel-title">
        @if(Auth::user()->can('add_secretary', $unit))
          <a href="{{route('panel.unit_users.create.secretary', ['unit_id' => $unit->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
        @endif
        {{__('unit_users.secretaries')}}
      </div>
      @if(sizeof($unit->secretaries))
        <table class="table">
          <thead>
            <tr>
              <th>{{__('users.row')}}</th>
              <th>{{__('users.first_name')}}</th>
              <th>{{__('users.last_name')}}</th>
              <th>{{__('users.group_code')}}</th>
              <th>{{__('users.status')}}</th>
              <th>{{__('users.operation')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($unit->secretaries as $index => $user)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$user->first_name_str}}</td>
                <td>{{$user->last_name_str}}</td>
                <td>{{$user->group_str}}</td>
                <td>{{$user->status_str}}</td>
                <td>
                  @if(Auth::user()->can('write_info', $user))
                    @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
                  @else
                    <a class="btn btn-default" href="{{route('panel.users.show', ['user' => $user])}}">{{__('users.show')}}</a>
                  @endif
                  @if(Auth::user()->can('add_secretary', $unit))
                    <a class="btn btn-warning" href="{{route('panel.unit_users.inline_update', ['unit_user' => $user->pivot->id, 'action' => 'cancel'])}}">{{__('unit_users.cancel')}}</a>
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
  @endif
</div>
@endsection
