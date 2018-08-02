@extends('layouts.main')
@section('title', __('experiments.create'))
@section('content')
<div class="test">
    <form action="{{route('panel.experiments.store')}}" method="POST">
        @csrf
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                <div class="form-group create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in  {{$errors->has('description')? 'has-error has-feedback': ''}}">
                            <div class="col-md-10">
                                @if($errors->has('description'))
                                    <span class="form-control-feedback error-span">{{$errors->first('description')}}</span>
                                @endif
                                <textarea class="form-control" name="description" rows="3" id="comment" style="width:90%">{{old('description', '')}}</textarea>
                            </div>
                            <label for="description" class="col-md-2 col-form-label text-center">{{__('experiments.report_description')}}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in  {{$errors->has('patient_id')? 'has-error has-feedback': ''}}">
                            <div class="col-md-10">
                                <select class="form-control" name="patient_id" style="width:90%;text-align:center">
                                    @foreach(Auth::user()->patients() as $patient)
                                        <option value="{{$patient->id}}">{{$patient->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="patient_id" class="col-md-2 col-form-label text-center">{{__('experiments.patient_id')}}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in  {{$errors->has('status')? 'has-error has-feedback': ''}}">
                            <div class="col-md-10">
                                <select class="form-control" name="status" style="width:90%;text-align:center">

                                    <option value="1">{{__('experiments.status_str.1')}}</option>
                                    <option value="2">{{__('experiments.status_str.2')}}</option>
                                </select>
                            </div>
                            <label for="status" class="col-md-2 col-form-label text-center">{{__('experiments.status')}}</label>
                        </div>
                    </div>
                </div>
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
                @submit(['value' => 'new'])
                {{__('experiments.save')}}
                @endsubmit
            </div>
        </div>
    </form>
</div>
@endsection