@extends('layouts.main')
@section('title', __('users.create.manager'))
@section('content')
<div class="container">
    @form_create(['action' => route('panel.users.store.manager'), 'title' => __('users.create.manager')])
    @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone'), 'row' => true])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email'), 'row' => true])
        <div class="form-group row create-form">
            @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name'), 'col' => 6])
            @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name'), 'col' => 6])
        </div>
        @php
            $status_rows = [
                ['label' => __('users.status_str.' . 1), 'value' => 1],
                ['label' => __('users.status_str.' . 2), 'value' => 2],
            ];
        @endphp
        @input_select(['name' => 'status', 'value' => old('status', 0), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_create
</div>
@endsection
