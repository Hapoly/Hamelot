@extends('layouts.main')
@section('title', __('units.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.units.store'), 'title' => __('units.create')])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => __('units.title'), 'required' => true])
    @input_text(['name' => 'address', 'value' => old('address', ''), 'label' => __('units.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('units.phone'), 'required' => false])
    @input_text(['name' => 'mobile', 'value' => old('mobile', ''), 'label' => __('units.mobile'), 'required' => false])
    @input_image(['name' => 'image', 'label' => __('units.image'), 'required' => true])
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat')])
    <?php
        $status_rows = [
          [ 'value' => 1, 'label' => __('units.status_str.1') ],
          [ 'value' => 2, 'label' => __('units.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => __('units.status'), 'required' => true, 'rows' => $status_rows])
    <?php
        $group_code_rows = [
          [ 'value' => 1, 'label' => __('units.group_code_str.1') ],
          [ 'value' => 2, 'label' => __('units.group_code_str.2') ],
          [ 'value' => 2, 'label' => __('units.group_code_str.3') ],
          [ 'value' => 2, 'label' => __('units.group_code_str.4') ],
        ];
    ?>
    @input_select(['name' => 'group_code', 'value' => old('group_code', ''), 'label' => __('units.group_code'), 'required' => true, 'rows' => $group_code_rows])
    <?php
        $type_rows = [
          [ 'value' => 1, 'label' => __('units.type_str.1') ],
          [ 'value' => 2, 'label' => __('units.type_str.2') ],
        ];
    ?>
    @input_select(['name' => 'type', 'value' => old('type', ''), 'label' => __('units.type'), 'required' => true, 'rows' => $type_rows])
    <?php
        $public_rows = [
          [ 'value' => 1, 'label' => __('units.public_str.1') ],
          [ 'value' => 2, 'label' => __('units.public_str.2') ],
        ];
    ?>
    @input_select(['name' => 'public', 'value' => old('public', ''), 'label' => __('units.public'), 'required' => true, 'rows' => $public_rows])
    @submit_row(['value' => 'new', 'label' => __('units.save')])
  @endform_create
</div>
@endsection