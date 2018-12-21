@extends('layouts.main')
@section('title', __('unit_users.create.member'))
@section('content')
<?php
  use App\Models\UnitUser;
?>
<div class="container">
  @if(session()->has('failed'))
    <div class="alert alert-danger" role="alert">
      {{session()->get('failed')}}
    </div>
  @endif
  @form_create(['action' => route('panel.unit_users.store'), 'title' => __('unit_users.create.member')])
    @autocomplete(['name' => 'full_name', 'label' => __('unit_users.full_name'), 'value' => old('full_name', $full_name), 'required' => true, 'route' => 'members', 'row' => true])
    @php
      $unit_strs = [];
      foreach($units as $unit){
        array_push($unit_strs, [
          'value' => $unit->id,
          'label' => $unit->title,
        ]);
      }
    @endphp
    @input_select(['name' => 'unit_id', 'value' => old('unit_id', $unit_id), 'label' => __('unit_users.unit_id'), 'required' => true, 'rows' => $unit_strs, 'row' => true])
    <input name="permission" value="{{UnitUser::MEMBER}}" hidden />
    <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <a style="text-decoration: underline;" href="{{route('panel.users.create.doctor', ['unit_id' => $unit_id])}}">{{__('unit_users.user_not_registered')}}</a>
        <button class="btn btn-primary" type="submit" value="new">{{__('unit_users.save')}}</button>
      </div>
    </div>
  @endform_create
</div>
@endsection
