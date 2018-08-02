@extends('layouts.main')
@section('title', __('reports.edit'))
@section('content')
<div class="test">
    <form action="{{route('panel.report_templates.update', ['report_template' => $report_template])}}" method="POST">
        {{ method_field('PUT') }}
        @csrf
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group test-in create-form {{$errors->has('title')? 'has-error has-feedback': ''}}" >
                        <div class="col-md-10">
                            @if($errors->has('title'))
                                <span class="form-control-feedback error-span">{{$errors->first('title')}}</span>
                            @endif
                            <input id="title" type="text" class="form-control" name="title" style="width:90%;" value="{{old('title', $report_template->title)}}">
                        </div>
                        <label for="title" class="col-md-2 col-form-label text-center">{{__('reports.report_title')}}</label>
                    </div>
                </div>
                <div class="form-group create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in  {{$errors->has('description')? 'has-error has-feedback': ''}}">
                            <div class="col-md-10">
                                @if($errors->has('description'))
                                    <span class="form-control-feedback error-span">{{$errors->first('description')}}</span>
                                @endif
                                <textarea class="form-control" name="description" rows="3" id="comment" style="width:90%">{{old('description', $report_template->description)}}</textarea>
                            </div>
                            <label for="description" class="col-md-2 col-form-label text-center">{{__('reports.report_description')}}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in  {{$errors->has('status')? 'has-error has-feedback': ''}}">
                            <div class="col-md-10">
                                <select class="form-control" name="status" style="width:90%;text-align:center">
                                    <option {{$report_template->status == 1? 'selected': ''}} value="1">{{__('reports.status_str.1')}}</option>
                                    <option {{$report_template->status == 2? 'selected': ''}} value="2">{{__('reports.status_str.2')}}</option>
                                </select>
                            </div>
                            <label for="status" class="col-md-2 col-form-label text-center">{{__('reports.status')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="fields">
            @if(sizeof(old('titles', [])) > 0)
                @for($i=0; $i<sizeof(old('titles', [])); $i++)
                    <div class="panel panel-default create-card"  id="field-{{$i+1}}" style="margin-top:30px;" >
                        <span class="closebtn" onclick="remove_field(1)">&times;</span> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group test-in create-form  {{$errors->has('titles.' . $i)? 'has-error has-feedback': ''}}" >
                                    <div class="col-md-10">
                                        @if($errors->has('titles.' . $i))
                                            <span class="form-control-feedback error-span">{{$errors->first('titles.' . $i)}}</span>
                                        @endif
                                        <input id="title" type="text" class="form-control" name="titles[]" style="width:90%;" value="{{old('titles.' . $i, '')}}">
                                    </div>
                                    <label for="title" class="col-md-2 col-form-label text-center">{{__('reports.title')}}</label>
                                </div>
                            </div>
                            <div class="form-group row create-form">
                                <div class="col-md-12">
                                    <div class="form-group test-in {{$errors->has('types.' . $i)? 'has-error has-feedback': ''}}">
                                        <div class="col-md-10">
                                            <select class="form-control type" name="types[]" id="type-{{$i+1}}" data-label="quantity-{{$i+1}}" style="width:90%;text-align:center">
                                                <option value="1" {{old('types.'.$i) == 1? 'selected': ''}} >{{__('reports.type_str.1')}}</option>
                                                <option value="2" {{old('types.'.$i) == 2? 'selected': ''}} >{{__('reports.type_str.2')}}</option>
                                                <option value="3" {{old('types.'.$i) == 3? 'selected': ''}} >{{__('reports.type_str.3')}}</option>
                                                <option value="4" {{old('types.'.$i) == 4? 'selected': ''}} >{{__('reports.type_str.4')}}</option>
                                                <option value="5" {{old('types.'.$i) == 5? 'selected': ''}} >{{__('reports.type_str.5')}}</option>
                                            </select>
                                        </div>
                                        <label for="type" class="col-md-2 col-form-label text-center">{{__('reports.type')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group test-in create-form" >
                                    <div class="col-md-10 {{$errors->has('labels.' . $i)? 'has-error has-feedback': ''}}">
                                        @if($errors->has('labels.' . $i))
                                            <span class="form-control-feedback error-span">{{$errors->first('labels.' . $i)}}</span>
                                        @endif
                                        <input id="label-{{$i+1}}" type="text" class="form-control" name="labels[]" style="width:90%;" value="{{old('labels.'.$i, '')}}">
                                    </div>
                                    <label for="label-{{$i+1}}" class="col-md-2 col-form-label text-center">{{__('reports.label')}}</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group test-in create-form" >
                                    <div class="col-md-10 {{$errors->has('quantities.' . $i)? 'has-error has-feedback': ''}}">
                                        @if($errors->has('quantities.' . $i))
                                            <span class="form-control-feedback error-span">{{$errors->first('quantities.' . $i)}}</span>
                                        @endif
                                        <input id="quantity-{{$i+1}}" type="text" class="form-control" name="quantities[]" style="width:90%;" value="{{old('quantities.'.$i, '')}}">
                                    </div>
                                    <label for="quantity-{{$i+1}}" class="col-md-2 col-form-label text-center">{{__('reports.quantity')}}</label>
                                </div>
                            </div>
                            <div class="form-group create-form">
                                <div class="col-md-12">
                                    <div class="form-group test-in {{$errors->has('descriptions.' . $i)? 'has-error has-feedback': ''}}">
                                        <div class="col-md-10">
                                            @if($errors->has('descriptions.' . $i))
                                                <span class="form-control-feedback error-span">{{$errors->first('descriptions.' . $i)}}</span>
                                            @endif
                                            <textarea class="form-control" rows="3" name="descriptions[]" id="comment" style="width:90%">{{old('descriptions.'.$i, '')}}</textarea>
                                        </div>
                                        <label for="status" class="col-md-2 col-form-label text-center">{{__('reports.description')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @else
                @foreach($report_template->fields as $i=>$field)
                    <div class="panel panel-default create-card"  id="field-{{$i+1}}" style="margin-top:30px;" >
                        <span class="closebtn" onclick="remove_field({{$i+1}})">&times;</span> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group test-in create-form" >
                                    <div class="col-md-10">
                                        <input id="title" type="text" class="form-control" name="titles[]" style="width:90%;" value="{{$field->title}}">
                                    </div>
                                    <label for="title" class="col-md-2 col-form-label text-center">{{__('reports.title')}}</label>
                                </div>
                            </div>
                            <div class="form-group row create-form">
                                <div class="col-md-12">
                                    <div class="form-group test-in">
                                        <div class="col-md-10">
                                            <select class="form-control type" name="types[]" id="type-{{$i+1}}" data-label="quantity-{{$i+1}}" style="width:90%;text-align:center">
                                                <option {{$field->type == 1? 'selected': ''}} value="1">{{__('reports.type_str.1')}}</option>
                                                <option {{$field->type == 2? 'selected': ''}} value="2">{{__('reports.type_str.2')}}</option>
                                                <option {{$field->type == 3? 'selected': ''}} value="3">{{__('reports.type_str.3')}}</option>
                                                <option {{$field->type == 4? 'selected': ''}} value="4">{{__('reports.type_str.4')}}</option>
                                                <option {{$field->type == 5? 'selected': ''}} value="5">{{__('reports.type_str.5')}}</option>
                                            </select>
                                        </div>
                                        <label for="type" class="col-md-2 col-form-label text-center">{{__('reports.type')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group test-in create-form" >
                                    <div class="col-md-10">
                                        <input id="label-{{$i+1}}" type="text" class="form-control" name="labels[]" style="width:90%;" value="{{$field->label}}">
                                    </div>
                                    <label for="label-{{$i+1}}" class="col-md-2 col-form-label text-center">{{__('reports.label')}}</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group test-in create-form" >
                                    <div class="col-md-10">
                                        <input id="quantity-{{$i+1}}" type="text" class="form-control" name="quantities[]" style="width:90%;" value="{{$field->quantity}}">
                                    </div>
                                    <label for="quantity-{{$i+1}}" class="col-md-2 col-form-label text-center">{{__('reports.quantity')}}</label>
                                </div>
                            </div>
                            <div class="form-group create-form">
                                <div class="col-md-12">
                                    <div class="form-group test-in">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="3" name="descriptions[]" id="comment" style="width:90%">{{$field->description}}</textarea>
                                            </div>
                                        </div>
                                        <label for="status" class="col-md-2 col-form-label text-center">{{__('reports.description')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-12">
                <button type="button" onclick="add_field()" class="btn accent-color text-primary-color new-meet">{{__('reports.new_field')}}</button>
                <button type="submit" class="btn btn-info" >{{__('reports.save')}}</button>
            </div>
        </div>
    </form>
</div>
<script>
function setOnChange(){
    $(".type").unbind( "change" );
    $(".type").change(function(e){
        let typeId = e.target.id
        let labelId = $("#" + typeId).attr('data-label');
        switch($("#"+typeId).val()){
            case "1":
            case "3":
                $("#" + labelId).prop('disabled', false);
                break;
            case "4":
            case "2":
                $("#" + labelId).prop('disabled', true);
                break;
        }
    })

}
setOnChange();
var last_field_index = {{sizeof(old('titles')) > 0? sizeof(old('titles')) + 1: $report_template->field_count+1}};
function remove_field(o){
    $("#field-" + o).remove();
}
function add_field(){
    last_field_index ++;
    $("#fields").append(
        "<div class='panel panel-default create-card'  id='field-"+last_field_index+"' style='margin-top:30px;' >"+
            "<span class='closebtn' onclick='remove_field("+last_field_index+")'>&times;</span>"+ 
            "<div class='row'>"+
                "<div class='col-md-12'>"+
                    "<div class='form-group test-in create-form' >"+
                        "<div class='col-md-10'>"+
                            "<input id='title' type='text' class='form-control' name='titles[]' style='width:90%;'>"+
                        "</div>"+
                        "<label for='title' class='col-md-2 col-form-label text-center'>{{__('reports.title')}}</label>"+
                    "</div>"+
                "</div>"+
                "<div class='form-group row create-form'>"+
                "    <div class='col-md-12'>"+
                "        <div class='form-group test-in'>"+
                "            <div class='col-md-10'>"+
                "                <select class='form-control type' name='types[]' id='type-"+last_field_index+"' data-label='quantity-"+last_field_index+"' style='width:90%;text-align:center'>"+
                "                <option value='1'>{{__('reports.type_str.1')}}</option>"+
                "                <option value='2'>{{__('reports.type_str.2')}}</option>"+
                "                <option value='3'>{{__('reports.type_str.3')}}</option>"+
                "                <option value='4'>{{__('reports.type_str.4')}}</option>"+
                "                <option value='5'>{{__('reports.type_str.5')}}</option>"+
                "                </select>"+
                "            </div>"+
                "            <label for='type' class='col-md-2 col-form-label text-center'>{{__('reports.type')}}</label>"+
                "        </div>"+
                "    </div>"+
                "</div>"+
                "<div class='col-md-12'>"+
                "    <div class='form-group test-in create-form' >"+
                "        <div class='col-md-10'>"+
                "            <input type='text' class='form-control' name='labels[]' style='width:90%;'>"+
                "        </div>"+
                "        <label  class='col-md-2 col-form-label text-center'>{{__('reports.label')}}</label>"+
                "    </div>"+
                "</div>"+
                "<div class='col-md-12'>"+
                "   <div class='form-group test-in create-form' >"+
                "       <div class='col-md-10'>"+
                "           <input id='quantity-"+last_field_index+"' type='text' class='form-control' name='quantities[]' style='width:90%;'>"+
                "       </div>"+
                "       <label for='quantity-"+last_field_index+"' class='col-md-2 col-form-label text-center'>{{__('reports.quantity')}}</label>"+
                "   </div>"+
                "</div>"+
                "<div class='form-group create-form'>"+
                    "<div class='col-md-12'>"+
                        "<div class='form-group test-in'>"+
                            "<div class='col-md-10'>"+
                                "<div class='form-group'>"+
                                "<textarea class='form-control' rows='3' id='descriptions' name='descriptions[]' style='width:90%'></textarea>"+
                                "</div>"+
                            "</div>"+
                            "<label for='status' class='col-md-2 col-form-label text-center'>{{__('reports.description')}}</label>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
            "</div>"+
        "</div>"
    );
    setOnChange();
}
</script>
@endsection