@extends('layouts.main')
@section('title', __('activity_times.edit'))
@section('content')
@php
  use App\Models\UnitUser;
@endphp
<div class="container">
  @form_edit(['action' => route('panel.activity-times.update', ['activity_time' => $activity_time]), 'title' => __('activity_times.edit')])
    @php
      $unit_user_rows = [];
      foreach(UnitUser::fetch()->get() as $unit_user){
        if(Auth::user()->isDoctor() || Auth::user()->isNurse()){
          array_push($unit_user_rows, [
            'value' => $unit_user->id,
            'label' => $unit_user->unit->complete_title,
          ]);
        }else if(Auth::user()->isManager()){
          array_push($unit_user_rows, [
            'value' => $unit_user->id,
            'label' => $unit_user->unit->complete_title . ' - ' . $unit_user->user->full_name,
          ]);
        }
      }
    @endphp
    @input_select(['name' => 'unit_user_id', 'value' => old('unit_user_id', $activity_time->unit_user_id), 'label' => __('activity_times.unit_user_id'), 'required' => true, 'rows' => $unit_user_rows])
    @php
      $day_of_week_rows = [];
      for($i=1; $i<=7; $i++)
        array_push($day_of_week_rows, [
          'label' => __('general.day_of_week.' . $i),
          'value' => $i
        ]);
    @endphp
    @input_select(['name' => 'day_of_week', 'value' => old('day_of_week', $activity_time->day_of_week), 'label' => __('activity_times.day_of_week'), 'required' => true, 'rows' => $day_of_week_rows])
    @input_day_time(['name' => 'start_time', 'value' => old('start_time', $activity_time->start_time), 'label' => __('activity_times.start_time')])
    @input_day_time(['name' => 'finish_time', 'value' => old('finish_time', $activity_time->finish_time), 'label' => __('activity_times.finish_time')])
    @submit_row(['value' => 'new', 'label' => __('activity_times.save')])
  @endform_create
</div>
@endsection