@extends('layouts.main')
@section('title', __('users.create.secretary'))
@section('content')
<div class="container">
    @form_create(['post' => true, 'action' => route('panel.users.store.secretary'), 'title' => __('users.create.secretary')])
            @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone'), 'row' => true])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email'), 'row' => true])
        @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name'), 'row' => true])
        @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name'), 'row' => true])
        @php
            $status_rows = [
                ['label' => __('users.status_str.' . 1), 'value' => 1],
                ['label' => __('users.status_str.' . 2), 'value' => 2],
            ];
        @endphp
        <input name="unit_id" value="{{$unit_id}}" hidden />
        @input_select(['name' => 'status', 'value' => old('status'), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_create
</div>
@endsection
