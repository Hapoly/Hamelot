@extends('layouts.main')
@section('title', __('users.profile_edit'))
@section('content')
<div class="container">
    @form_edit(['post' => true, 'action' => route('panel.profile.admin'), 'title' => __('users.profile_edit')])
        @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email', Auth::user()->email_str), 'row' => true])
        @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name', Auth::user()->first_name_str), 'row' => true])
        @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name', Auth::user()->last_name_str), 'row' => true])
        @submit_row(['value' => 'save', 'label' => __('users.save')])
    @endform_edit
</div>
@endsection
