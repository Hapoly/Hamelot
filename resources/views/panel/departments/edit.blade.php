@extends('layouts.main')
@section('title', __('departments.edit'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.departments.update', ['department' => $department]), 'title' => __('departments.edit')])
    @input_text(['name' => 'title', 'value' => old('title', $department->title), 'label' => __('departments.title'), 'required' => true])
    @input_text(['name' => 'description', 'value' => old('description', $department->description), 'label' => __('departments.description'), 'required' => true])
    <?php
        $hospital_rows = [];
        foreach($hospitals as $hospital){
        array_push($hospital_rows, [
            'value' => $hospital->id,
            'label' => $hospital->title
        ]);
        }
    ?>
    @input_select(['name' => 'hospital_id', 'value' => old('hospital_id', $department->hospital_id), 'label' => __('departments.hospital_id'), 'required' => true, 'rows' => $hospital_rows])
    <?php
        $status_rows = [
        [ 'value' => 1, 'label' => __('departments.status_str.1') ],
        [ 'value' => 2, 'label' => __('departments.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', $department->status), 'label' => __('departments.status'), 'required' => true, 'rows' => $status_rows])
    @submit_row(['value' => 'new', 'label' => __('departments.save')])
  @endform_edit
</div>
@endsection
