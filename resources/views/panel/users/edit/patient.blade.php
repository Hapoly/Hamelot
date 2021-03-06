@extends('layouts.main')
@section('title', __('users.edit.patient'))
@section('content')
<div class="container">
    @form_edit(['post' => true, 'action' => route('panel.users.update.patient', ['user' => $user]), 'title' => __('users.edit.patient')])
        @input_image(['name' => 'profile', 'label' => __('users.profile'), 'col' => 12])
        @if(Auth::user()->isAdmin())
            @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone', $user->phone), 'row' => true])
        @endif
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email', $user->email_str), 'row' => true])
        @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', $user->first_name_str), 'row' => true])
        @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', $user->last_name_str), 'row' => true])
        @input_text(['name' => 'id_number', 'label' => __('users.id_number'), 'value' => old('id_number', $user->patient->id_number_str), 'row' => true])
        @input_date(['name' => 'birth_', 'year' => old('birth_year', $user->patient->birth_year), 'month' => old('birth_month', $user->patient->birth_month), 'day' => old('birth_day', $user->patient->birth_day), 'label' => __('users.birth_date'), 'row' => true])
        @php
            $gender_rows = [
                ['label' => __('users.gender_str.' . 1), 'value' => 1],
                ['label' => __('users.gender_str.' . 2), 'value' => 2],
            ];
        @endphp
        @input_select(['name' => 'gender', 'value' => old('gender', $user->patient->gender), 'label' => __('users.gender'), 'required' => true, 'rows' => $gender_rows, 'row' => true])
        @if(Auth::user()->isAdmin())
            @php
                $status_rows = [
                    ['label' => __('users.status_str.' . 1), 'value' => 1],
                    ['label' => __('users.status_str.' . 2), 'value' => 2],
                ];
            @endphp
            @input_select(['name' => 'status', 'value' => old('status', $user->patient->status), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
        @endif
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_edit
</div>
@endsection
