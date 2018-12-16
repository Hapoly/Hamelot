@extends('layouts.main')
@section('title', __('users.create.patient'))
@section('content')
<?php
    use App\Models\Unit;
?>
<div class="container">
    @form_create(['action' => route('panel.users.store.patient'), 'title' => __('users.create.patient')])
        @input_image(['name' => 'profile', 'label' => __('users.profile'), 'col' => 12])
        @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone'), 'row' => true])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email'), 'row' => true])
        @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name'), 'row' => true])
        @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name'), 'row' => true])
        @input_text(['name' => 'id_number', 'label' => __('users.id_number'), 'value' => old('id_number'), 'row' => true])
        @php
            $status_rows = [
                ['label' => __('users.status_str.' . 1), 'value' => 1],
                ['label' => __('users.status_str.' . 2), 'value' => 2],
            ];
        @endphp
        @input_select(['name' => 'status', 'value' => old('status', 0), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
        @input_date(['name' => 'birth_', 'year' => old('birth_year'), 'month' => old('birth_month'), 'day' => old('birth_day'), 'label' => __('users.birth_date'), 'row' => true])
        <div class="form-group row create-form">
            @php
                $gender_rows = [
                    ['label' => __('users.gender_str.' . 1), 'value' => 1],
                    ['label' => __('users.gender_str.' . 2), 'value' => 2],
                ];
            @endphp
            @input_select(['name' => 'gender', 'value' => old('gender', 0), 'label' => __('users.gender'), 'required' => true, 'rows' => $gender_rows, 'col' => 6])
            @php
                $status_rows = [
                    ['label' => __('users.status_str.' . 1), 'value' => 1],
                    ['label' => __('users.status_str.' . 2), 'value' => 2],
                ];
            @endphp
            @input_select(['name' => 'status', 'value' => old('status', 0), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'col' => 6])
        </div>
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_create
</div>
@endsection
