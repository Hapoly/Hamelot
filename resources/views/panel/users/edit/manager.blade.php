@extends('layouts.main')
@section('title', __('users.edit.manager'))
@section('content')
<div class="container">
@form_edit(['post' => true, 'action' => route('panel.users.update.manager', ['user' => $user]), 'title' => __('users.edit.manager')])
    @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone', $user->phone), 'row' => true])
        @input_text(['name' => 'username', 'label' => __('users.username'), 'value' => old('username', $user->username), 'row' => true])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email', $user->email_str), 'row' => true])
        <div class="form-group row create-form">
            @input_text(['name' => 'password', 'label' => __('users.password'), 'value' => old('password'), 'col' => 6, 'type' => 'password'])
            @input_text(['name' => 'password_confirmation', 'label' => __('users.password_confirmation'), 'value' => old('password_confirmation'), 'col' => 6, 'type' => 'password'])
        </div>
        <div class="form-group row create-form">
            @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', $user->first_name_str), 'col' => 6])
            @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', $user->last_name_str), 'col' => 6])
        </div>
        @php
            $status_rows = [
                ['label' => __('users.status_str.' . 1), 'value' => 1],
                ['label' => __('users.status_str.' . 2), 'value' => 2],
            ];
        @endphp
        @input_select(['name' => 'status', 'value' => old('status', $user->status), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_edit
</div>
@endsection
