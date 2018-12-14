@extends('layouts.main')
@section('title', $user->first_name_str . ' ' . $user->last_name_str)
@section('content')
<div class="container">
  <div class="panel panel-default">
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
          @if(Auth::user()->isAdmin())
            <tr>
              <td>{{__('users.phone')}}</td>
              <td>{{$user->phone}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    @if(Auth::user()->isAdmin())
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
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <h2>{{__('units.index_title')}}</h2>
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
              <td>
                @operation_th(['base' => 'panel.units', 'label' => 'user', 'item' => $user, 'remove_label' => __('units.remove'), 'edit_label' => __('units.edit'), 'show_label' => __('units.show')])
              </td>
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