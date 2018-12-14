@extends('layouts.main')
@section('title', __('users.profile_edit'))
@section('content')
<div class="container">
    @form_edit(['post' => true, 'action' => route('panel.profile.patient'), 'title' => __('users.profile_edit')])
        @input_image(['name' => 'profile', 'label' => __('users.profile'), 'col' => 12])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email', Auth::user()->email_str), 'row' => true])
        <div class="form-group row create-form">
            @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', Auth::user()->first_name_str), 'col' => 6])
            @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', Auth::user()->last_name_str), 'col' => 6])
        </div>
        @input_text(['name' => 'id_number', 'label' => __('users.id_number'), 'value' => old('id_number', Auth::user()->patient->id_number_str), 'row' => true])
        @input_date(['name' => 'birth_', 'year' => old('birth_year', Auth::user()->patient->birth_year), 'month' => old('birth_month', Auth::user()->patient->birth_month), 'day' => old('birth_day', Auth::user()->patient->birth_day), 'label' => __('users.birth_date'), 'row' => true])
        @php
            $gender_rows = [
                ['label' => __('users.gender_str.' . 1), 'value' => 1],
                ['label' => __('users.gender_str.' . 2), 'value' => 2],
            ];
        @endphp
        @input_select(['name' => 'gender', 'value' => old('gender', Auth::user()->patient->gender), 'label' => __('users.gender'), 'required' => true, 'rows' => $gender_rows, 'row' => true])
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_edit
</div>
@endsection
