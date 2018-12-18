@extends('layouts.main')
@section('title', __('activity_times.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.activity-times.store'), 'title' => __('activity_times.create')])
    @php
      $unit_user_rows = [];
      foreach($unit_users as $unit_user){
        if(Auth::user()->isDoctor() || Auth::user()->isNurse()){
          array_push($unit_user_rows, [
            'value' => $unit_user->id,
            'label' => $unit_user->unit->complete_title,
          ]);
        }else if(Auth::user()->isManager() || Auth::user()->isAdmin() || Auth::user()->isSecretary()){
          array_push($unit_user_rows, [
            'value' => $unit_user->id,
            'label' => $unit_user->unit->complete_title . ' - ' . $unit_user->user->full_name,
          ]);
        }
      }
    @endphp
    @input_select(['name' => 'unit_user_id', 'value' => old('unit_user_id', ''), 'label' => __('activity_times.unit_user_id'), 'required' => true, 'row' => true, 'rows' => $unit_user_rows])
    @php
      $day_of_week_rows = [];
      for($i=1; $i<=7; $i++)
        array_push($day_of_week_rows, [
          'label' => __('general.day_of_week.' . $i),
          'value' => $i
        ]);
    @endphp
    @input_select(['name' => 'day_of_week', 'value' => old('day_of_week', ''), 'label' => __('activity_times.day_of_week'), 'required' => true, 'row' => true, 'rows' => $day_of_week_rows])
  
    @input_day_time(['name' => 'start_time', 'value' => old('start_time', time()), 'row' => true, 'label' => __('activity_times.start_time')])
    @input_day_time(['name' => 'finish_time', 'value' => old('finish_time', time()), 'row' => true, 'label' => __('activity_times.finish_time')])
    <input hidden name="auto_fill" value="1" />
    <input hidden name="just_in_unit_visit" value="3" />
    <input hidden name="default_deposit" value="0" />
    <input hidden name="default_demand_time" value="0" />
    @input_currency(['help' => __('activity_times.deafult_price_description'), 'name' => 'default_price', 'value' => old('default_price', 1000), 'label' => __('activity_times.default_price'), 'row' => true, 'required' => true, 'min' => 0, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn')])
    @input_number(['help' => __('activity_times.deamnd_limit_description'), 'name' => 'demand_limit', 'value' => old('demand_limit', 0), 'label' => __('activity_times.demand_limit'), 'row' => true, 'required' => true, 'min' => 0, 'max' => 1000, 'placeholder' => 'نفر'])
    @submit_row(['value' => 'new', 'label' => __('activity_times.save')])
  @endform_create
</div>
@endsection