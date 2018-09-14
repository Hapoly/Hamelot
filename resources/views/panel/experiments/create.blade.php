@extends('layouts.main')
@section('title', __('experiments.create'))
@section('content')
<?php
    use App\Drivers\Time;
?>
<div class="test">
    @form_create(['action' => route('panel.experiments.store'), 'title' => __('experiments.create')])
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
                @input_select(['name' => 'user_id', 'value' => old('user_id', 'N'), 'label' => __('experiments.user_id'), 'required' => true, 'rows' => $patient_rows])
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
                @input_select(['name' => 'unit_id', 'value' => old('unit_id', 'N'), 'label' => __('experiments.unit_id'), 'required' => true, 'rows' => $unit_rows])
                @input_date(['name' => '', 'year' => old('year', Time::year()), 'month' => old('month', Time::month()), 'day' => old('day', Time::day())])
                <input hidden name="report_template_id" value="{{$report_template->id}}" />
            </div>
        </div>
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                @foreach($report_template->fields as $field)
                    @if($field->isInteger())
                        @input_number(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, ''), 'required' => false])
                    @endif
                    @if($field->isFloat())
                        @input_number(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, ''), 'required' => false])
                    @endif
					@if($field->isString())
                        @input_text(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, ''), 'required' => false])
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
                        @input_select(['label' => $field->title, 'name' => 'field_' . $field->id, 'value' => old('field_' . $field->id, ''), 'required' => false, 'rows' => $rows])
                    @endif
                @endforeach
            </div>
        </div>
        @submit_row(['value' => 'new', 'label' => __('experiments.save')])
    @endform_create
</div>
@endsection