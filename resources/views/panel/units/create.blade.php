@extends('layouts.main')
@section('title', __('hospitals.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.hospitals.store'), 'title' => __('hospitals.create')])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => __('hospitals.title'), 'required' => true])
    @input_text(['name' => 'address', 'value' => old('address', ''), 'label' => __('hospitals.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('hospitals.phone'), 'required' => false])
    @input_text(['name' => 'mobile', 'value' => old('mobile', ''), 'label' => __('hospitals.mobile'), 'required' => false])
    <?php
        $status_rows = [
        [ 'value' => 1, 'label' => __('hospitals.status_str.1') ],
        [ 'value' => 2, 'label' => __('hospitals.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => __('hospitals.status'), 'required' => true, 'rows' => $status_rows])
    @input_image(['name' => 'image', 'label' => __('hospitals.image'), 'required' => true])
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat')])
    @submit_row(['value' => 'new', 'label' => __('hospitals.save')])
  @endform_create
</div>
@endsection