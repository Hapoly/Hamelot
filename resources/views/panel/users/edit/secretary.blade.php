@extends('layouts.main')
@section('title', __('users.edit.secretary'))
@section('content')
<div class="container">
    @form_edit(['post' => true, 'action' => route('panel.users.update.secretary', ['user' => $user]), 'title' => __('users.edit.secretary')])
        @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone', $user->phone), 'row' => true])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email', $user->email_str), 'row' => true])
        @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', $user->first_name_str), 'row' => true])
        @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', $user->last_name_str), 'row' => true])
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
