@extends('layouts.main')
@section('title', __('off_times.create'))
@section('content')
@php
  use App\Models\UnitUser;
@endphp
<div class="container">
  @form_create(['action' => route('panel.off-times.store'), 'title' => __('off_times.create')])
    @php
      $unit_user_rows = [];
      if(Auth::user()->isDoctor() || Auth::user()->isNurse())
        array_push($unit_user_rows, [
          'value' => '0',
          'label' => __('off_times.all_unit_users')
        ]);
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
    @input_select(['name' => 'unit_user_id', 'value' => old('unit_user_id', ''), 'label' => __('off_times.unit_user_id'), 'required' => true, 'rows' => $unit_user_rows])
    @input_date_complete(['name' => 'start_date', 'label' => __('off_times.start_date'), 'value'  => old('start_date', time()), 'required' => true])
    @input_date_complete(['name' => 'finish_date', 'label' => __('off_times.finish_date'), 'value'  => old('finish_date', time()), 'required' => true])
    @submit_row(['value' => 'new', 'label' => __('off_times.save')])
  @endform_create
</div>
@endsection