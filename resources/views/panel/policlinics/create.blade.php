@extends('layouts.main')
@section('title', __('policlinics.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.policlinics.store'), 'title' => __('policlinics.create')])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => __('policlinics.title'), 'required' => true])
    @input_text(['name' => 'address', 'value' => old('address', ''), 'label' => __('policlinics.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('policlinics.phone'), 'required' => true])
    @input_text(['name' => 'mobile', 'value' => old('mobile', ''), 'label' => __('policlinics.mobile'), 'required' => true])
    <?php
        $status_rows = [
        [ 'value' => 1, 'label' => __('policlinics.status_str.1') ],
        [ 'value' => 2, 'label' => __('policlinics.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => __('policlinics.status'), 'required' => true, 'rows' => $status_rows])
    @input_image(['name' => 'image', 'label' => __('policlinics.image'), 'required' => true])
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat')])
    @submit_row(['value' => 'new', 'label' => __('policlinics.save')])
  @endform_create
</div>
@endsection
