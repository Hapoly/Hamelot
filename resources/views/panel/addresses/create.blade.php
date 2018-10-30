@extends('layouts.main')
@section('title', __('addresses.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.addresses.store'), 'title' => __('addresses.create')])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => __('addresses.title'), 'required' => true])
    @input_text(['name' => 'plain', 'value' => old('plain', ''), 'label' => __('addresses.plain'), 'required' => false])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('addresses.phone'), 'required' => false])
    @if(Auth::user()->isAdmin())
      @autocomplete(['name' => 'full_name', 'label' => __('addresses.full_name'), 'value' => old('full_name'), 'required' => true, 'route' => 'patients'])
    @endif
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat')])
    @submit_row(['value' => 'new', 'label' => __('addresses.save')])
  @endform_create
</div>
@endsection