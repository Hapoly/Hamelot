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
          <tr>
            <td>{{__('activity_times.auto_fill')}}</td>
            <td>{{$activity_time->auto_fill_str}}</td>
          </tr>
          @if($activity_time->auto_fill == 1)
            <tr>
                <td>{{__('activity_times.default_price')}}</td>
                <td>{{$activity_time->default_price_str}}</td>
            </tr>
            <tr>
                <td>{{__('activity_times.default_deposit')}}</td>
                <td>{{$activity_time->default_deposit_str}}</td>
            </tr>
            <tr>
                <td>{{__('activity_times.demand_limit')}}</td>
                <td>{{$activity_time->demand_limit_str}}</td>
            </tr>
            <tr>
                <td>{{__('activity_times.default_demand_time')}}</td>
                <td>{{$activity_time->default_demand_time_str}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    <div class="row">
      @if(Auth::user()->can('modify', $activity_time))
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.activity-times.edit', ['activity_time' => $activity_time])}}" class="btn btn-primary" role="button">{{__('activity_times.edit')}}</a>
        </div>
      @endif
      @if(Auth::user()->can('destroy', $activity_time))
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.activity-times.destroy', ['activity_time' => $activity_time])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
