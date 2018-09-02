@extends('layouts.main')
@section('title', __('policlinics.edit'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.policlinics.update', ['policlinic' => $policlinic]), 'title' => __('policlinics.edit')])
    @input_text(['name' => 'title', 'value' => old('title', $policlinic->title), 'label' => __('policlinics.title'), 'required' => true])
    @input_text(['name' => 'address', 'value' => old('address', $policlinic->address), 'label' => __('policlinics.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', $policlinic->phone), 'label' => __('policlinics.phone'), 'required' => true])
    @input_text(['name' => 'mobile', 'value' => old('mobile', $policlinic->mobile), 'label' => __('policlinics.mobile'), 'required' => true])
    <?php
        $status_rows = [
        [ 'value' => 1, 'label' => __('policlinics.status_str.1') ],
        [ 'value' => 2, 'label' => __('policlinics.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', $policlinic->status), 'label' => __('policlinics.status'), 'required' => true, 'rows' => $status_rows])
    @input_image(['name' => 'image', 'label' => __('policlinics.image'), 'required' => true])
    @input_city(['city_id' => old('city_id', $policlinic->city_id), 'lon' => old('lon', $policlinic->lon), 'lat' => old('lat', $policlinic->lat), 'province_id' => old('province_id', $policlinic->city->province_id)])
    @submit_row(['value' => 'edit', 'label' => __('policlinics.save')])
  @endform_create
</div>
@endsection
