@extends('layouts.main')
@section('title', __('hospitals.edit'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.hospitals.update', ['hospital' => $hospital]), 'title' => __('hospitals.edit')])
    @input_text(['name' => 'title', 'value' => old('title', $hospital->title), 'label' => __('hospitals.title'), 'required' => true])
    @input_text(['name' => 'address', 'value' => old('address', $hospital->address), 'label' => __('hospitals.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', $hospital->phone), 'label' => __('hospitals.phone'), 'required' => false])
    @input_text(['name' => 'mobile', 'value' => old('mobile', $hospital->mobile), 'label' => __('hospitals.mobile'), 'required' => false])
    <?php
        $status_rows = [
        [ 'value' => 1, 'label' => __('hospitals.status_str.1') ],
        [ 'value' => 2, 'label' => __('hospitals.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', $hospital->status), 'label' => __('hospitals.status'), 'required' => true, 'rows' => $status_rows])
    @input_image(['name' => 'image', 'label' => __('hospitals.image'), 'required' => true])
    @input_city(['city_id' => old('city_id', $hospital->city_id), 'lon' => old('lon', $hospital->lon), 'lat' => old('lat', $hospital->lat), 'province_id' => old('province_id', $hospital->city->province_id)])
    @submit_row(['value' => 'edit', 'label' => __('hospitals.save')])
  @endform_create
</div>
@endsection
