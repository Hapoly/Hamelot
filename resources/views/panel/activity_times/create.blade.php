@extends('layouts.main')
@section('title', __('activity_times.create'))
@section('content')
@php
  use App\Models\UnitUser;
@endphp
<div class="container">
  @form_create(['action' => route('panel.activity-times.store'), 'title' => __('activity_times.create')])
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
    <div class="">
      @input_select(['name' => 'unit_user_id', 'value' => old('unit_user_id', ''), 'label' => __('activity_times.unit_user_id'), 'required' => true, 'col'=>6, 'rows' => $unit_user_rows])
  
      @php
        $day_of_week_rows = [];
        for($i=1; $i<=7; $i++)
          array_push($day_of_week_rows, [
            'label' => __('general.day_of_week.' . $i),
            'value' => $i
          ]);
      @endphp
      @input_select(['name' => 'day_of_week', 'value' => old('day_of_week', ''), 'label' => __('activity_times.day_of_week'), 'required' => true, 'col'=>6, 'rows' => $day_of_week_rows])
      @input_day_time(['name' => 'start_time', 'value' => old('start_time', time()), 'col'=>6, 'label' => __('activity_times.start_time')])
      @input_day_time(['name' => 'finish_time', 'value' => old('finish_time', time()), 'col'=>6, 'label' => __('activity_times.finish_time')])
    
      @php
        $auto_fill_rows = [
          ['label'  => __('activity_times.auto_fill_str.' . 0), 'value' => 0],
          ['label'  => __('activity_times.auto_fill_str.' . 1), 'value' => 1],
        ];
      @endphp
      @tagline
        {{__('activity_times.auto_fill_description')}}
      @endtagline
     
      @input_select(['name' => 'auto_fill', 'value' => old('auto_fill', '1'), 'col'=>6, 'label' => __('activity_times.auto_fill'), 'required' => true, 'rows' => $auto_fill_rows])

      @php
        $just_in_unit_visit_rows = [
          ['label'  => __('activity_times.just_in_unit_visit_str.' . 1), 'value' => 1],
          ['label'  => __('activity_times.just_in_unit_visit_str.' . 2), 'value' => 2],
          ['label'  => __('activity_times.just_in_unit_visit_str.' . 3), 'value' => 3],
        ];
      @endphp
      @input_select(['name' => 'just_in_unit_visit', 'value' => old('just_in_unit_visit', '1'), 'label' => __('activity_times.just_in_unit_visit'), 'required' => true, 'col'=>6, 'rows' => $just_in_unit_visit_rows])
    
    </div>
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

        @tagline
          {{__('activity_times.deafult_price_description')}}
        @endtagline
        @input_currency(['name' => 'default_price', 'value' => old('default_price', 1000), 'label' => __('activity_times.default_price'), 'col'=>6, 'required' => true, 'min' => 0, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn')])

        @tagline
        {{__('activity_times.default_deposit_description')}}
        @endtagline
        @input_currency(['name' => 'default_deposit', 'value' => old('default_deposit', 0), 'label' => __('activity_times.default_deposit'), 'col'=>6, 'required' => true, 'min' => 1000, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn')])

        @tagline
          {{__('activity_times.deamnd_limit_description')}}
        @endtagline
        @input_number(['name' => 'demand_limit', 'value' => old('demand_limit', 0), 'label' => __('activity_times.demand_limit'), 'col'=>6, 'required' => true, 'min' => 0, 'max' => 1000, 'placeholder' => 'نفر'])

        @tagline
        {{__('activity_times.default_demand_time_description')}}
        @endtagline
        @input_number(['name' => 'default_demand_time', 'value' => old('default_demand_time', 0), 'label' => __('activity_times.default_demand_time'), 'col'=>6, 'required' => true, 'min' => 0, 'max' => 1000, 'placeholder' => 'نفر'])

      @submit_row(['value' => 'new', 'label' => __('activity_times.save')])
    @endform_create

</div>
@endsection