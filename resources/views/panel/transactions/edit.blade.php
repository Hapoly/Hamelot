@extends('layouts.main')
@section('title', __('addresses.edit'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.addresses.update', ['address' => $address]), 'title' => __('addresses.edit')])
  @input_text(['name' => 'title', 'value' => old('title', $address->title), 'label' => __('addresses.title'), 'required' => true])
    @input_text(['name' => 'plain', 'value' => old('plain', $address->plain), 'label' => __('addresses.plain'), 'required' => false])
    @if(Auth::user()->isAdmin())
      @autocomplete(['name' => 'full_name', 'label' => __('addresses.full_name'), 'value' => old('full_name', $address->user->full_name), 'required' => true, 'route' => 'patients'])
    @endif
    @input_city(['city_id' => old('city_id', $address->city->id), 'province_id' => old('province_id', $address->city->province->id), 'lon' => old('lon', $address->lon), 'lat' => old('lat', $address->lat)])
    @submit_row(['value' => 'edit', 'label' => __('addresses.save')])
  @endform_create
</div>
@endsection
