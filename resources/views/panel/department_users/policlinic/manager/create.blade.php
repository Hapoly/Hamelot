@extends('layouts.main')
@section('title', __('department_users.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.department_users.store'), 'title' => __('department_users.create')])
    @autocomplete(['name' => 'full_name', 'label' => __('department_users.full_name'), 'value' => old('full_name'), 'required' => true, 'route' => 'managers'])
    <?php
      $policlinic_strs = [];
      foreach($policlinics as $policlinic){
        array_push($policlinic_strs, [
          'value' => $policlinic->id,
          'label' => $policlinic->title,
        ]);
      }
    ?>
    @input_select(['name' => 'department_id', 'value' => old('department_id', ''), 'label' => __('department_users.policlinic_id'), 'required' => true, 'rows' => $policlinic_strs])
    <input hidden value="1" name="type" />
    @submit_row(['value' => 'new', 'label' => __('department_users.save')])
  @endform_create
</div>
@endsection
