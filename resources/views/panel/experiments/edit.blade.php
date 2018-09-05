@extends('layouts.main')
@section('title', __('experiments.edit'))
@section('content')
<div class="test">
    @form_edit(['action' => route('panel.experiments.update', ['experiment' => $experiment]), 'title' => __('experiments.edit')])
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                @autocomplete(['name' => 'patient_name', 'label' => __('experiments.patient_name'), 'value' => old('patient_name', $experiment->user->first_name . ' ' . $experiment->user->last_name), 'required' => true, 'route' => 'patients'])
				<script>
                    $(document).ready(function(){
                        $("#patient_name").change(function(){
                            let patient_name = $("#patient_name").val();
                            console.log('searchin for ' + patient_name);
                            var settings = {
                                "async": true,
                                "crossDomain": true,
                                "url": "{{route('panel.search.patient-departments')}}",
                                "method": "GET",
                                "headers": {},
                                "data": {
                                    "term": patient_name
                                }
                            }
                            $.ajax(settings).done(function (response) {
                                let result_str = '';
                                for(let i=0; i<response.length; i++){
                                    result_str += '\n<option value="'+response[i].id+'">'+response[i].title+'</option>'
                                }
                                $("#department_id").empty();
                                $("#department_id").append(result_str);
                            });
                        });
                    })
                </script>
                <input hidden name="report_template_id" value="{{$experiment->report_template->id}}" />
                <?php
                    $department_rows = [[
                        'value' => 0,
                        'label'  => 'انتخاب نشده',
                    ]];
                    foreach($experiment->user->departments as $department)
                        array_push($department_rows, [
                            'value' => $department->id,
                            'label' => $department->title,
                        ]);
                ?>
                @input_select(['name' => 'department_id', 'value' => old('department_id', ''), 'label' => __('experiments.department_id'), 'required' => true, 'rows' => $department_rows])
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