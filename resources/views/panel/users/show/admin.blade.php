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
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection