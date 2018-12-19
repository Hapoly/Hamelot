@extends('layouts.main')
@section('title', __('activity_times.index_title'))
@section('content')
<div class="filter-panel">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-heading">جستجو</div>
        <div class="panel-body">
          <form>
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="day_of_week" id="day_of_week" style="width: 100%">
                    <option value="0"> تمام روز‌های هفته</option>
                    @for($i=1; $i<=7; $i++)
                      <option value="{{$i}}" {{isset($filters)? ($filters['day_of_week'] == $i? 'selected': ''): ''}}>{{__('general.day_of_week.' . $i)}}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-12">
                <button class="btn btn-info" type="submit">{{__('activity_times.search')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-bottom:50px;">
  @php
  @endphp
  @table([
    'route' => 'panel.activity-times.index', 
    'hasAny' => sizeof($activity_times) > 0, 
    'not_found' => __('activity_times.not_found'),
    'items' => $activity_times,
    'search'  => $search,
    'cols' => [
      'id'            => __('activity_times.row'),
      'unit_user_id'  => __('activity_times.unit_user_id'),
      'time'          => __('activity_times.time'),
      'auto_fill'     => __('activity_times.auto_fill'),
      'NuLL'          => __('activity_times.operation'),
    ]])
    @foreach($activity_times as $index => $activity_time)
      <tr class="activity_time-td">
        <td>{{$index+1}}</td>
        @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
          <td>{{$activity_time->unit_user->unit->complete_title}}</td>
        @else
          <td>{{$activity_time->unit_user->unit->complete_title}} , {{$activity_time->unit_user->user->full_name}}</td>
        @endif
        <td>{{$activity_time->time_str}}</td>
        <td>{{$activity_time->auto_fill_str}}</td>
        @if($activity_time->permission_to_write)
          <td>
            @operation_th(['base' => 'panel.activity-times', 'label' => 'activity_time', 'item' => $activity_time, 'remove_label' => __('activity_times.remove'), 'edit_label' => __('activity_times.edit'), 'show_label' => __('activity_times.show')])
          </td>
        @else
          <td><a class="btn btn-default" href="{{route('panel.activity-times.show', ['$activity_time' => $activity_time])}}">{{__('activity_times.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $activity_times->links()])
</div>
@endsection
