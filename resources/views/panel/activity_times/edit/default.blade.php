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
      foreach(UnitUser::fetch()->where('permission', UnitUser::MEMBER)->get() as $unit_user){
        if(Auth::user()->isDoctor() || Auth::user()->isNurse()){
          array_push($unit_user_rows, [
            'value' => $unit_user->id,
            'label' => $unit_user->unit->complete_title,
          ]);
        }else if(Auth::user()->isManager() || Auth::user()->isAdmin()){
          array_push($unit_user_rows, [
            'value' => $unit_user->id,
            'label' => $unit_user->unit->complete_title . ' - ' . $unit_user->user->full_name,
          ]);
        }
      }
    @endphp
    @input_select(['name' => 'unit_user_id', 'value' => old('unit_user_id', $activity_time->unit_user_id), 'label' => __('activity_times.unit_user_id'), 'required' => true, 'rows' => $unit_user_rows, 'row' => true])
    @php
      $day_of_week_rows = [];
      for($i=1; $i<=7; $i++)
        array_push($day_of_week_rows, [
          'label' => __('general.day_of_week.' . $i),
          'value' => $i
        ]);
    @endphp
    @input_select(['name' => 'day_of_week', 'value' => old('day_of_week', $activity_time->day_of_week), 'label' => __('activity_times.day_of_week'), 'required' => true, 'rows' => $day_of_week_rows, 'row' => true])
    @input_day_time(['name' => 'start_time', 'value' => old('start_time', $activity_time->start_time), 'label' => __('activity_times.start_time'), 'row' => true])
    @input_day_time(['name' => 'finish_time', 'value' => old('finish_time', $activity_time->finish_time), 'label' => __('activity_times.finish_time'), 'row' => true])
    @php
      $auto_fill_rows = [
        ['label'  => __('activity_times.auto_fill_str.' . 0), 'value' => 0],
        ['label'  => __('activity_times.auto_fill_str.' . 1), 'value' => 1],
      ];
    @endphp
    @input_select(['help' => __('activity_times.auto_fill_description'), 'name' => 'auto_fill', 'value' => old('auto_fill', $activity_time->auto_fill), 'label' => __('activity_times.auto_fill'), 'required' => true, 'rows' => $auto_fill_rows, 'row' => true])
    @php
      $just_in_unit_visit_rows = [
        ['label'  => __('activity_times.just_in_unit_visit_str.' . 0), 'value' => 0],
        ['label'  => __('activity_times.just_in_unit_visit_str.' . 1), 'value' => 1],
        ['label'  => __('activity_times.just_in_unit_visit_str.' . 1), 'value' => 1],
      ];
    @endphp
    @input_select(['name' => 'just_in_unit_visit', 'value' => old('just_in_unit_visit', '1'), 'label' => __('activity_times.just_in_unit_visit'), 'required' => true, 'rows' => $just_in_unit_visit_rows, 'row' => true])
    <script>
      $(document).ready(function(){
        function update_auto_fill(){
          let value = $('#auto_fill').val();
          if(value == '0'){
            $('#default_price').attr('disabled', true);
            $('#default_deposit').attr('disabled', true);
            $('#demand_limit').attr('disabled', true);
            $('#default_demand_time').attr('disabled', true);
          }else if(value == '1'){
            $('#default_price').attr('disabled', false);
            $('#default_deposit').attr('disabled', false);
            $('#demand_limit').attr('disabled', false);
            $('#default_demand_time').attr('disabled', false);
          }
        }
        $('#auto_fill').change(function(){
          update_auto_fill();
        });
        update_auto_fill();
      });
    </script>
    @input_currency(['help' => __('activity_times.deafult_price_description'), 'name' => 'default_price', 'value' => old('default_price', $activity_time->default_price), 'label' => __('activity_times.default_price'), 'required' => true, 'min' => 0, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn'), 'row' => true])
    @input_currency(['help' => __('activity_times.default_deposit_description'), 'name' => 'default_deposit', 'value' => old('default_deposit', $activity_time->default_deposit), 'label' => __('activity_times.default_deposit'), 'required' => true, 'min' => 1000, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn'), 'row' => true])
    @input_number(['help' => __('activity_times.deamnd_limit_description'), 'name' => 'demand_limit', 'value' => old('demand_limit', $activity_time->demand_limit), 'label' => __('activity_times.demand_limit'), 'required' => true, 'min' => 0, 'max' => 1000, 'placeholder' => 'نفر', 'row' => true])
    @input_number(['help' => __('activity_times.default_demand_time_description'), 'name' => 'default_demand_time', 'value' => old('default_demand_time', $activity_time->default_demand_time), 'label' => __('activity_times.default_demand_time'), 'required' => true, 'min' => 0, 'max' => 1000, 'placeholder' => 'نفر', 'row' => true])
    @submit_row(['value' => 'new', 'label' => __('activity_times.save')])
  @endform_create
</div>
@endsection