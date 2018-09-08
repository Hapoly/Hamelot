@extends('layouts.main')
@section('title', __('unit_users.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.unit_users.store'), 'title' => __('unit_users.create')])
    @autocomplete(['name' => 'full_name', 'label' => __('unit_users.full_name'), 'value' => old('full_name'), 'required' => true, 'route' => 'members'])
    <?php
      $department_strs = [];
      foreach($departments as $department){
        array_push($department_strs, [
          'value' => $department->id,
          'label' => $department->title,
        ]);
      }
    ?>
    @input_select(['name' => 'unit_id', 'value' => old('unit_id', ''), 'label' => __('unit_users.department_id'), 'required' => true, 'rows' => $department_strs])
    <input hidden value="2" name="type" />
    @submit_row(['value' => 'new', 'label' => __('unit_users.save')])
  @endform_create
</div>
@endsection
