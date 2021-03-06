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
          <a href="{{route('panel.users.edit', ['user' => $user])}}" id="edit" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.destroy', ['user' => $user])}}" id="remove" class="btn btn-danger" role="button">{{__('users.remove')}}</a>
        </div>
      </div>
    @endif
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.info', ['user' => $user])}}">{{__('users.print_info')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection