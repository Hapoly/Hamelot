@extends('layouts.app')
@section('title', $user->first_name . ' ' . $user->last_name)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $user->first_name }} {{ $user->last_name }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$user->username}}</div>
            <div class="col-md-3">:{{__('users.username')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->first_name}}</div>
            <div class="col-md-3">:{{__('users.first_name')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->last_name}}</div>
            <div class="col-md-3">:{{__('users.last_name')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->prefix}}</div>
            <div class="col-md-3">:{{__('users.prefix')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->group_code_str()}}</div>
            <div class="col-md-3">:{{__('users.group_code')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->status_str()}}</div>
            <div class="col-md-3">:{{__('users.status')}}</div>
          </div>
          <div class="row">
            <a href="{{route('users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit')}}</a>
            <form action="{{route('users.destroy', ['user' => $user])}}" method="post">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger">حذف</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
