@extends('layouts.main')
@section('title', 'مرخصی')
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $off_time->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$off_time->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('off_times.unit_user_id')}}</td>
            @if($off_time->unit_user_id == '0')
              <td>{{__('off_times.all_unit_users')}}</td>
            @else
              <td>{{$off_time->unit_user->unit->title}}</td>
            @endif
          </tr>
          @if(!(Auth::user()->isDoctor() || Auth::user()->isNurse()))
            <tr>
              <td>{{__('users.full_name')}}</td>
              <td>{{$off_time->unit_user->user->full_name}}</td>
            </tr>
          @endif
          <tr>
            <td>{{__('off_times.time')}}</td>
            <td>{{$off_time->time_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.activity-times.edit', ['off_time' => $off_time])}}" class="btn btn-primary" role="button">{{__('off_times.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.activity-times.destroy', ['off_time' => $off_time])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
