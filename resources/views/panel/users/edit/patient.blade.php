@extends('layouts.main')
@section('title', __('users.edit.patient'))
@section('content')
<div class="container">
    @form_edit(['post' => true, 'action' => route('panel.users.update.patient', ['user' => $user]), 'title' => __('users.edit.patient')])
        @input_image(['name' => 'profile', 'label' => __('users.profile'), 'col' => 12])
        @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone', $user->phone), 'row' => true])
        @input_text(['name' => 'username', 'label' => __('users.username'), 'value' => old('username', $user->username), 'row' => true])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email', $user->email_str), 'row' => true])
        <div class="form-group row create-form">
            @input_text(['name' => 'password', 'label' => __('users.password'), 'value' => old('password'), 'col' => 6, 'type' => 'password'])
            @input_text(['name' => 'password_confirmation', 'label' => __('users.password_confirmation'), 'value' => old('password_confirmation', $user->password_confirmation), 'col' => 6, 'type' => 'password'])
        </div>
        <div class="form-group row create-form">
            @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', $user->first_name), 'col' => 6])
            @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', $user->last_name), 'col' => 6])
        </div>
        @input_text(['name' => 'id_number', 'label' => __('users.id_number'), 'value' => old('id_number', $user->patient->id_number), 'row' => true])
        @input_date(['name' => 'birth_', 'year' => old('birth_year', $user->birth_year), 'month' => old('birth_month', $user->birth_month), 'day' => old('birth_day', $user->birth_day), 'label' => __('users.birth_date'), 'row' => true])
        <div class="form-group row create-form">
            @php
                $gender_rows = [
                    ['label' => __('users.gender_str.' . 1), 'value' => 1],
                    ['label' => __('users.gender_str.' . 2), 'value' => 2],
                ];
            @endphp
            @input_select(['name' => 'gender', 'value' => old('gender', $user->patient->gender), 'label' => __('users.gender'), 'required' => true, 'rows' => $gender_rows, 'col' => 6])
            @php
                $status_rows = [
                    ['label' => __('users.status_str.' . 1), 'value' => 1],
                    ['label' => __('users.status_str.' . 2), 'value' => 2],
                ];
            @endphp
            @input_select(['name' => 'status', 'value' => old('status', $user->patient->status), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'col' => 6])
        </div>
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_edit
</div>
@endsection
