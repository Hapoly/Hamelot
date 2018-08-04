@extends('layouts.main')
@section('title', __('experiments.create'))
@section('content')
<div class="test">
    @form_create(['action' => route('panel.experiments.store'), 'title' => __('experiments.create')])
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                @autocomplete(['name' => 'patient_name', 'label' => __('experiments.patient_name'), 'value' => old('patient_name'), 'required' => true])
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
                <input hidden name="report_template_id" value="{{$report_template->id}}" />
                @input_select(['name' => 'department_id', 'value' => old('department_id', ''), 'label' => __('experiments.department_id'), 'required' => true, 'rows' => []])
                @input_date(['name' => '', 'year' => old('year'), 'month' => old('month'), 'day' => old('day')])
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