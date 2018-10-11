@extends('layouts.main')
@section('title', $activity_time->unit_user->unit->complete_title)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $activity_time->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$activity_time->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('units.title')}}</td>
            <td>{{$activity_time->unit_user->unit->title}}</td>
          </tr>
          @if(!(Auth::user()->isDoctor() || Auth::user()->isNurse()))
            <tr>
              <td>{{__('users.full_name')}}</td>
              <td>{{$activity_time->unit_user->user->full_name}}</td>
            </tr>
          @endif
          <tr>
            <td>{{__('activity_times.time')}}</td>
            <td>{{$activity_time->time_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.activity-times.edit', ['activity_time' => $activity_time])}}" class="btn btn-primary" role="button">{{__('activity_times.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.activity-times.destroy', ['activity_time' => $activity_time])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
