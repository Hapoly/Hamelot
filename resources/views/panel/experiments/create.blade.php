@extends('layouts.main')
@section('title', __('experiments.create'))
@section('content')
<div class="test">
    <form action="{{route('panel.experiments.store')}}" method="POST">
        @csrf
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
                @input_select(['name' => 'department_id', 'value' => old('department_id', ''), 'label' => __('experiments.department_id'), 'required' => true, 'rows' => []])
            </div>
        </div>
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                @foreach($report_template->fields as $field)
                        <div class="col-md-12">
                            <div class="form-group test-in create-form {{$errors->has('field_' . $field->id)? 'has-error has-feedback': ''}}" >
                                @if($field->isInteger())
                                    <div class="col-md-10">
                                        @if($errors->has('field_' . $field->id))
                                            <span class="form-control-feedback error-span">{{$errors->first('field_' . $field->id)}}</span>
                                        @endif
                                        <input id="field_{{$field->id}}" type="number" class="form-control" name="field_{{$field->id}}" style="width:90%;" value="{{old('field_' . $field->id, '')}}">
                                    </div>
                                    <label for="field_{{$field->id}}" class="col-md-2 col-form-label text-center">{{$field->title}}</label>
                                @endif
                                @if($field->isString())
                                    <div class="col-md-10">
                                        @if($errors->has('field_' . $field->id))
                                            <span class="form-control-feedback error-span">{{$errors->first('field_' . $field->id)}}</span>
                                        @endif
                                        <input id="field_{{$field->id}}" type="text" class="form-control" name="field_{{$field->id}}" style="width:90%;" value="{{old('field_' . $field->id, '')}}">
                                    </div>
                                    <label for="field_{{$field->id}}" class="col-md-2 col-form-label text-center">{{$field->title}}</label>
                                @endif
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-12">
                @submit(['value' => 'new', 'label' => __('experiments.save')])
            </div>
        </div>
    </form>
</div>
@endsection