@extends('layouts.main')
@section('title', __('department_users.create'))
@section('content')
<?php
  use App\Models\UnitUser;
?>
<div class="container">
  @form_create(['action' => route('panel.department_users.store'), 'title' => __('department_users.create')])
    @autocomplete(['name' => 'full_name', 'label' => __('department_users.full_name'), 'value' => old('full_name'), 'required' => true, 'route' => 'doctor_nurses'])
    @input_radio(['name' => 'type', 'id' => 'type_'.UnitUser::POLICLINIC, 'label' => __('department_users.policlinic_type'), 'value' => UnitUser::POLICLINIC, 'checked' => false])
    <?php
      $policlinic_strs = [];
      foreach($policlinics as $policlinic){
        array_push($policlinic_strs, [
          'value' => $policlinic->id,
          'label' => $policlinic->title,
        ]);
      }
    ?>
    @input_select(['name' => 'policlinic_id', 'value' => old('policlinic_id', ''), 'label' => __('department_users.policlinic_id'), 'required' => true, 'rows' => $policlinic_strs, 'disabled' => true])
    <?php
      $permission_strs = [
        ['value' => 1, 'label' => __('department_users.permission_str.1')],
        ['value' => 2, 'label' => __('department_users.permission_str.2')],
      ];
    ?>
    @input_select(['name' => 'permission', 'value' => old('permission', ''), 'label' => __('department_users.permission'), 'required' => true, 'rows' => $permission_strs, 'disabled' => true])
    @input_radio(['name' => 'type', 'id' => 'type_'.UnitUser::DEPARTMENT, 'label' => __('department_users.department_type'), 'value' => UnitUser::DEPARTMENT, 'checked' => true])
    <?php
      $department_strs = [];
      foreach($departments as $department){
        array_push($department_strs, [
          'value' => $department->id,
          'label' => $department->title . ' - (' . $department->hospital->title . ')',
        ]);
      }
    ?>
    @input_select(['name' => 'department_id', 'value' => old('department_id', ''), 'label' => __('department_users.department_id'), 'required' => true, 'rows' => $department_strs, 'disabled' => false])
    @submit_row(['value' => 'new', 'label' => __('department_users.save')])
  @endform_create
  <script>
    $(document).ready(function(){
      $('#type_{{UnitUser::POLICLINIC}}').change(function(){
        $('#department_id').prop('disabled', true);
        $('#policlinic_id').prop('disabled', false);
        $('#permission').prop('disabled', false);
      });
      $('#type_{{UnitUser::DEPARTMENT}}').change(function(){
        $('#policlinic_id').prop('disabled', true);
        $('#permission').prop('disabled', true);
        $('#department_id').prop('disabled', false);
      });
    });
  </script>
</div>
@endsection
