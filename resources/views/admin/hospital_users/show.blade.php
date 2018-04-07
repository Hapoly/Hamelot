@extends('layouts.app')
@section('title', $hospital_user->user->first_name . ' ' . $hospital_user->user->last_name . ' - ' . $hospital_user->hospital->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $hospital_user->hospital->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$hospital_user->hospital->title}}</div>
            <div class="col-md-3">:{{__('hospital_users.hospital_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$hospital_user->user->first_name}} {{$hospital_user->user->last_name}}</div>
            <div class="col-md-3">:{{__('hospital_users.user_id')}}</div>
          </div>
          <div class="row">
            <a href="{{route('hospital_users.edit', ['hospital_user' => $hospital_user])}}" class="btn btn-primary" role="button">{{__('hospital_users.edit')}}</a>
            <form action="{{route('hospital_users.destroy', ['hospital_user' => $hospital_user])}}" method="post">
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
