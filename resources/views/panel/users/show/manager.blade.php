@extends('layouts.main')
@section('title', $user->first_name . ' ' . $user->last_name)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('users.first_name')}}</td>
            <td>{{$user->first_name}}</td>
          </tr>
          <tr>
            <td>{{__('users.last_name')}}</td>
            <td>{{$user->last_name}}</td>
          </tr>
          <tr>
            <td>{{__('users.status')}}</td>
            <td>{{$user->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if(Auth::user()->isAdmin())
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
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
    <h2>{{__('hospitals.index_title')}}</h2>
    @if(sizeof($user->hospitals))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('hospitals.row')}}</th>
            <th>{{__('hospitals.title')}}</th>
            <th>{{__('hospitals.status')}}</th>
            <th>{{__('hospitals.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->hospitals as $hospital)
            <tr>
              <td>{{$hospital->id}}</td>
              <td><a href="{{route('panel.hospitals.show', ['hospital' => $hospital])}}">{{$hospital->title}}</a></td>
              <td>{{$hospital->status_str}}</td>
              <td>
                @operation_th(['base' => 'panel.hospitals', 'label' => 'user', 'item' => $user, 'remove_label' => __('hospitals.remove'), 'edit_label' => __('hospitals.edit'), 'show_label' => __('hospitals.show')])
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('hospitals.not_found')}}
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <h2>{{__('policlinics.index_title')}}</h2>
    @if(sizeof($user->policlinics))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('policlinics.row')}}</th>
            <th>{{__('policlinics.title')}}</th>
            <th>{{__('policlinics.status')}}</th>
            <th>{{__('policlinics.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->policlinics as $hospital)
            <tr>
              <td>{{$hospital->id}}</td>
              <td><a href="{{route('panel.policlinics.show', ['hospital' => $hospital])}}">{{$hospital->title}}</a></td>
              <td>{{$hospital->status_str}}</td>
              <td>
                @operation_th(['base' => 'panel.policlinics', 'label' => 'user', 'item' => $user, 'remove_label' => __('policlinics.remove'), 'edit_label' => __('policlinics.edit'), 'show_label' => __('policlinics.show')])
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('policlinics.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection