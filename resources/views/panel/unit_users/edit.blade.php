@extends('layouts.main')
@section('title', __('hospitals.edit'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.hospitals.update', ['hospital' => $hospital]), 'title' => __('hospitals.create')])
    @input_text(['name' => 'title', 'value' => old('title', $hospital->title), 'label' => __('hospitals.title'), 'required' => true])
    @input_text(['name' => 'address', 'value' => old('address', $hospital->address), 'label' => __('hospitals.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', $hospital->phone), 'label' => __('hospitals.phone'), 'required' => true])
    @input_text(['name' => 'mobile', 'value' => old('mobile', $hospital->mobile), 'label' => __('hospitals.mobile'), 'required' => true])
    <?php
        $status_rows = [
        [ 'value' => 1, 'label' => __('hospitals.status_str.1') ],
        [ 'value' => 2, 'label' => __('hospitals.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', $hospital->status), 'label' => __('hospitals.status'), 'required' => true, 'rows' => $status_rows])
    @input_image(['name' => 'image', 'label' => __('hospitals.image'), 'required' => true])
    @submit_row(['value' => 'new', 'label' => __('hospitals.save')])
  @endform_create
</div>
@endsection
