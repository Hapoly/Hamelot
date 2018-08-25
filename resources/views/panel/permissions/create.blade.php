@extends('layouts.main')
@section('title', __('permissions.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.permissions.check'), 'title' => __('permissions.create')])
    @input_text(['name' => 'id_number', 'value' => old('id_number', ''), 'label' => __('permissions.id_number'), 'required' => true])
    @submit_row(['value' => 'new', 'label' => __('permissions.save')])
  @endform_create
</div>
@endsection
