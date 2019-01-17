@extends('layouts.main')
@section('title', __('users.profile_edit'))
@section('content')
<div class="container">
  @form_edit(['post' => true, 'action' => route('panel.profile.doctor'), 'title' => __('users.profile_edit')])
    @input_image(['name' => 'profile', 'label' => __('users.profile'), 'col' => 12, 'value' => Auth::user()->doctor->profile_url])
    @input_text(['name' => 'email', 'label' => __('users.email'), 'placeholder' => 'اختیاری', 'value' => old('email', Auth::user()->email_str), 'row' => true])
    @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', Auth::user()->first_name_item), 'row' => true])
    @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', Auth::user()->last_name_item), 'row' => true])
    @input_text(['name' => 'slug', 'label' => __('users.slug'), 'value' => old('slug', Auth::user()->slug), 'row' => true])
    @php
      $gender_rows = [
        ['label' => __('users.gender_str.' . 1), 'value' => 1],
        ['label' => __('users.gender_str.' . 2), 'value' => 2],
      ];
    @endphp
    @input_select(['name' => 'gender', 'value' => old('gender', Auth::user()->doctor->gender), 'label' => __('users.gender'), 'required' => true, 'rows' => $gender_rows, 'row' => true])
    @input_text(['name' => 'msc', 'label' => __('users.msc_doctor'), 'value' => old('msc', Auth::user()->doctor->msc_str), 'row' => true])
    @input_number(['name' => 'start_year', 'label' => __('users.start_year_doctor'), 'value' => old('start_year', (Auth::user()->doctor->start_year == 0)? '' : Auth::user()->doctor->start_year), 'min' => 1360, 'max' => 1400, 'row' => true])
    @multiautocomplete(['name' => 'fields', 'label' => __('users.fields'), 'value' => old('fields', Auth::user()->fields_str), 'required' => true, 'route' => 'fields.doctor'])
    @submit_row(['value' => 'save', 'label' => __('users.save')])
  @endform_edit
</div>
@endsection
