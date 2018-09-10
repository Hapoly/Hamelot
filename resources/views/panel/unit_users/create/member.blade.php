@extends('layouts.main')
@section('title', __('unit_users.create.member'))
@section('content')
<?php
  use App\Models\UnitUser;
?>
<div class="container">
  @form_create(['action' => route('panel.unit_users.store'), 'title' => __('unit_users.create.member')])
    @autocomplete(['name' => 'full_name', 'label' => __('unit_users.full_name'), 'value' => old('full_name'), 'required' => true, 'route' => 'members'])
    <?php
      $unit_strs = [];
      foreach($units as $unit){
        array_push($unit_strs, [
          'value' => $unit->id,
          'label' => $unit->title,
        ]);
      }
    ?>
    @input_select(['name' => 'unit_id', 'value' => old('unit_id', $unit_id), 'label' => __('unit_users.unit_id'), 'required' => true, 'rows' => $unit_strs])
    <input name="permission" value="{{UnitUser::MEMBER}}" hidden />
    @submit_row(['value' => 'new', 'label' => __('unit_users.save')])
  @endform_create
</div>
@endsection
