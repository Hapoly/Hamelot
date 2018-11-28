@extends('layouts.main')
@section('title', __('users.create.doctor'))
@section('content')
<div class="container">
    <div class="panel panel-default create-card">
        <h2>{{ __('users.create.doctor') }}</h2>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('panel.users.store.doctor') }}" enctype="multipart/form-data">
                    @csrf
                    @input_image(['name' => 'profile', 'label' => __('users.profile'), 'col' => 12])
                    @input_text(['name' => 'phone', 'label' => __('users.phone'), 'value' => old('phone'), 'row' => true])
                    @input_text(['name' => 'username', 'label' => __('users.username'), 'value' => old('username'), 'row' => true])
                    @input_text(['name' => 'email', 'label' => __('users.email'), 'value' => old('email'), 'row' => true])
                    <div class="form-group row create-form">
                        @input_text(['name' => 'password', 'label' => __('users.password'), 'value' => old('password'), 'col' => 6, 'type' => 'password'])
                        @input_text(['name' => 'password_confirmation', 'label' => __('users.password_confirmation'), 'value' => old('password_confirmation'), 'col' => 6, 'type' => 'password'])
                    </div>
                    <div class="form-group row create-form">
                        @input_text(['name' => 'first_name', 'label' => __('users.first_name'), 'value' => old('first_name'), 'col' => 6])
                        @input_text(['name' => 'last_name', 'label' => __('users.last_name'), 'value' => old('last_name'), 'col' => 6])
                    </div>
                    <div class="form-group row create-form">
                        @php
                            $degree_rows = [];
                            foreach($degrees as $degree){
                                array_push($degree_rows, [
                                    'label' => $degree->title,
                                    'value' => $degree->id,
                                ]);
                            }
                        @endphp
                        @input_select(['name' => 'degree_id', 'value' => old('degree_id', 0), 'label' => __('users.degree'), 'required' => true, 'rows' => $degree_rows, 'col' => 6])
                        
                        @php
                            $field_rows = [];
                            foreach($fields as $field){
                                array_push($field_rows, [
                                    'label' => $field->title,
                                    'value' => $field->id,
                                ]);
                            }
                        @endphp
                        @input_select(['name' => 'field_id', 'value' => old('field_id', 0), 'label' => __('users.field'), 'required' => true, 'rows' => $field_rows, 'col' => 6])
                    </div>
                    @php
                        $gender_rows = [
                            ['label' => __('users.gender_str.' . 1), 'value' => 1],
                            ['label' => __('users.gender_str.' . 2), 'value' => 2],
                        ];
                    @endphp
                    @input_select(['name' => 'gender_id', 'value' => old('gender_id', 0), 'label' => __('users.gender'), 'required' => true, 'rows' => $gender_rows, 'row' => true])
                    
                    @input_text(['name' => 'msc', 'label' => __('users.msc'), 'value' => old('msc'), 'row' => true])
                    <div class="form-group row create-form">
                        @php
                            $public_rows = [
                                ['label' => __('users.public_str.' . 1), 'value' => 1],
                                ['label' => __('users.public_str.' . 2), 'value' => 2],
                            ];
                        @endphp
                        @input_select(['name' => 'public_id', 'value' => old('public_id', 0), 'label' => __('users.public'), 'required' => true, 'rows' => $public_rows, 'col' => 6])
                        
                        @php
                            $status_rows = [
                                ['label' => __('users.status_str.' . 1), 'value' => 1],
                                ['label' => __('users.status_str.' . 2), 'value' => 2],
                            ];
                        @endphp
                        @input_select(['name' => 'status_id', 'value' => old('status_id', 0), 'label' => __('users.status'), 'required' => true, 'rows' => $status_rows, 'col' => 6])
                    </div>
                    @submit_row(['value' => 'save', 'label' => __('users.save')])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
