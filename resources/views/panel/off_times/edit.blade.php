@extends('layouts.main')
@section('title', __('off_times.edit'))
@section('content')
@php
  use App\Models\UnitUser;
@endphp
<div class="container">
  @form_edit(['action' => route('panel.off-times.update', ['off_time' => $off_time]), 'title' => __('off_times.edit')])
    @php
      $unit_user_rows = [];
      foreach(UnitUser::fetch()->get() as $unit_user){
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
    @input_select(['name' => 'unit_user_id', 'value' => old('unit_user_id', $off_time->unit_user_id), 'label' => __('off_times.unit_user_id'), 'required' => true, 'rows' => $unit_user_rows])
    @input_day_time(['name' => 'start_time', 'value' => old('start_time', $off_time->start_time), 'label' => __('off_times.start_time')])
    @input_day_time(['name' => 'finish_time', 'value' => old('finish_time', $off_time->finish_time), 'label' => __('off_times.finish_time')])
    @submit_row(['value' => 'new', 'label' => __('off_times.save')])
  @endform_create
</div>
@endsection