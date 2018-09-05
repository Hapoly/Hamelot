@extends('layouts.main')
@section('title', __('clinics.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.clinics.store'), 'title' => __('clinics.create')])
    @input_text(['name' => 'address', 'value' => old('address', ''), 'label' => __('clinics.address'), 'required' => true])
    @autocomplete(['name' => 'doctor_name', 'label' => __('clinics.doctor_name'), 'value' => old('doctor_name'), 'required' => true, 'route' => 'doctors'])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('clinics.phone'), 'required' => false])
    @input_text(['name' => 'mobile', 'value' => old('mobile', ''), 'label' => __('clinics.mobile'), 'required' => false])
    @tagline
      {{__('clinics.public_description')}}
    @endtagline
    <?php
        $public_rows = [
          [ 'value' => 1, 'label' => __('clinics.public_str.1') ],
          [ 'value' => 2, 'label' => __('clinics.public_str.2') ],
        ];
    ?>
    @input_select(['name' => 'public', 'value' => old('public', ''), 'label' => __('clinics.public'), 'required' => true, 'rows' => $public_rows])
    @tagline
      {{__('clinics.type_description')}}
    @endtagline
    <?php
        $type_rows = [
          [ 'value' => 1, 'label' => __('clinics.type_str.1') ],
          [ 'value' => 2, 'label' => __('clinics.type_str.2') ],
        ];
    ?>
    @input_select(['name' => 'type', 'value' => old('type', ''), 'label' => __('clinics.type'), 'required' => true, 'rows' => $type_rows])
    @input_image(['name' => 'image', 'label' => __('clinics.image'), 'required' => true])
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat')])
    @submit_row(['value' => 'new', 'label' => __('clinics.save')])
  @endform_create
</div>
@endsection
