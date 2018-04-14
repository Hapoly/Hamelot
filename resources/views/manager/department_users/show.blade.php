@extends('layouts.app')
@section('title', $department_user->user->first_name . ' ' . $department_user->user->last_name . ' - ' . $department_user->department->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $department_user->department->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$department_user->department->title}}</div>
            <div class="col-md-3">:{{__('department_users.department_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$department_user->user->first_name}} {{$department_user->user->last_name}}</div>
            <div class="col-md-3">:{{__('department_users.user_id')}}</div>
          </div>
          <div class="row">
            <a href="{{route('manager.department_users.edit', ['department_user' => $department_user])}}" class="btn btn-primary" role="button">{{__('department_users.edit')}}</a>
            <form action="{{route('manager.department_users.destroy', ['department_user' => $department_user])}}" method="post">
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
