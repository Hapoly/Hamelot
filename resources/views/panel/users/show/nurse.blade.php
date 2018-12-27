@extends('layouts.main')
@section('title', $user->first_name_str . ' ' . $user->last_name_str)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$user->nurse->profile_url}}" class="center" style="width: 25%">
    </div>
    <div class="row">
      <h2>{{ $user->first_name_str }} {{ $user->last_name_str }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('users.first_name')}}</td>
            <td>{{$user->first_name_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.last_name')}}</td>
            <td>{{$user->last_name_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.status')}}</td>
            <td>{{$user->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.fields')}}</td>
            <td>{{$user->fields_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.msc')}}</td>
            <td>{{$user->msc_str}}</td>
          </tr>
          @if(Auth::user()->isAdmin())
            <tr>
              <td>{{__('users.phone')}}</td>
              <td>{{$user->phone}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    @if(Auth::user()->can('write_info', $user))
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" id="edit" role="button">{{__('users.edit.general')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" id="remove" role="button">{{__('users.remove')}}</a>
        </div>
      </div>
    @endif
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.info', ['user' => $user])}}">{{__('users.print_info')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.units', ['user' => $user])}}">{{__('users.print_units')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.patients', ['user' => $user])}}">{{__('users.print_patients')}}</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      @if($user->has_permission_to_request_unit)
        <a href="{{route('panel.unit_users.create.member', ['user_id' => $user->id])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('units.index_title')}}
    </div>
    @if(sizeof($user->units))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('units.row')}}</th>
            <th>{{__('units.title')}}</th>
            <th>{{__('units.status')}}</th>
            <th>{{__('units.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->units as $index => $unit)
            <tr>
              <td>{{$index+1}}</td>
              <td><a href="{{route('panel.units.show', ['unit' => $unit])}}">{{$unit->title}}</a></td>
              <td>{{$unit->status_str}}</td>
              @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                <td>
                  @operation_th(['base' => 'panel.units', 'label' => 'unit', 'item' => $unit, 'remove_label' => __('units.remove'), 'edit_label' => __('units.edit'), 'show_label' => __('units.show')])
                  <a class="btn btn-warning" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit->pivot->id, 'action' => 'cancel'])}}">{{__('unit_users.cancel')}}</a>
                </td>
              @endif
              @if(Auth::user()->isPatient())
                <td>
                  <a class="btn btn-default" href="{{route('panel.demands.create.unit_user', ['unit' => $unit, 'user' => $user])}}">{{__('demands.create_unit_user')}}</a>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('units.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection