@extends('layouts.main')
@section('title', __('experiments.edit'))
@section('content')
<div class="test">
    @form_edit(['action' => route('panel.experiments.update', ['experiment' => $experiment]), 'title' => __('experiments.edit')])
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                <?php
                    $patient_rows = [[
                        'value' => "N",
                        'label'  => 'انتخاب نشده',
                    ]];
                    foreach($patients as $patient)
                        array_push($patient_rows, [
                            'value' => $patient->id,
                            'label' => $patient->full_name,
                        ]);
                ?>
                @input_select(['name' => 'user_id', 'value' => old('user_id', $experiment->user_id), 'label' => __('experiments.user_id'), 'required' => true, 'rows' => $patient_rows])
                <?php
                    $unit_rows = [[
                        'value' => "N",
                        'label'  => 'انتخاب نشده',
                    ]];
                    foreach($units as $unit)
                        array_push($unit_rows, [
                            'value' => $unit->id,
                            'label' => $unit->complete_title,
                        ]);
                ?>
                @input_select(['name' => 'unit_id', 'value' => old('unit_id', $experiment->unit_id), 'label' => __('experiments.unit_id'), 'required' => true, 'rows' => $unit_rows])
                @input_date(['name' => '', 'year' => old('year'), 'month' => old('month'), 'day' => old('day')])
            </div>
        </div>
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                @foreach($experiment->report_template->fields as $field)
                    @if($field->isInteger())
                        @input_number(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, $experiment->field_value($field)), 'required' => false])
                    @endif
                    @if($field->isFloat())
                        @input_number(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, $experiment->field_value($field)), 'required' => false])
                    @endif
					@if($field->isString())
                        @input_text(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, $experiment->field_value($field)), 'required' => false])
                    @endif
                    @if($field->isImage())
                        @input_image(['label' => $field->title, 'name' => 'field_' . $field->id, 'required' => false])
                    @endif
					@if($field->isBoolean())
                        <?php
                            $rows = [
                                [ 'value' => "1", 'label' => __('general.select_str.1') ],
                                [ 'value' => "2", 'label' => __('general.select_str.2') ],
                            ];
                        ?>
                        @input_select(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, $experiment->field_value($field)), 'required' => false, 'rows' => $rows])
                    @endif
                @endforeach
            </div>
        </div>
        @submit_row(['value' => 'edit', 'label' => __('experiments.save')])
    @endform_edit
</div>
@endsection