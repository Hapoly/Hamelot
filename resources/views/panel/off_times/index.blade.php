@extends('layouts.main')
@section('title', __('off_times.index_title'))
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
                      <option value="$i" {{isset($filters)? ($filters['day_of_week'] == $i? 'selected': ''): ''}}>{{__('general.day_of_week.1')}}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-12">
                <button class="btn btn-info" type="submit">{{__('off_times.search')}}</button>
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
    'hasAny' => sizeof($off_times) > 0, 
    'not_found' => __('off_times.not_found'),
    'items' => $off_times,
    'search'  => $search,
    'cols' => [
      'id'            => __('off_times.row'),
      'unit_user_id'  => __('off_times.unit_user_id'),
      'time'          => __('off_times.time'),
      'NuLL'          => __('off_times.operation'),
    ]])
    @foreach($off_times as $index => $off_time)
      <tr class="off_time-td">
        <td>{{$index+1}}</td>
        @if(Auth::user()->isDoctor() || Auth::user()->isNurse())
          @if($off_time->unit_user_id == '0')
            <td>{{__('off_times.all_unit_users')}}</td>
          @else
            <td>{{$off_time->unit_user->unit->complete_title}}</td>
          @endif
        @else
          @if($off_time->unit_user_id == '0')
            <td>{{__('off_times.all_unit_users')}} , {{$off_time->unit_user->user->full_name}}</td>
          @else
            <td>{{$off_time->unit_user->unit->complete_title}} , {{$off_time->unit_user->user->full_name}}</td>
          @endif
        @endif
        <td>{{$off_time->time_str}}</td>
        @if($off_time->permission_to_write)
          <td>
            @operation_th(['base' => 'panel.activity-times', 'label' => 'off_time', 'item' => $off_time, 'remove_label' => __('off_times.remove'), 'edit_label' => __('off_times.edit'), 'show_label' => __('off_times.show')])
          </td>
        @else
          <td><a class="btn btn-default" href="{{route('panel.activity-times.show', ['$off_time' => $off_time])}}">{{__('off_times.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $off_times->links()])
</div>
@endsection
