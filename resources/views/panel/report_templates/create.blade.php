@extends('layouts.main')
@section('title', __('reports.create'))
@section('content')
<div class="test">
    <form id="fields">
        <div class="panel panel-default create-card"  id="field-1" style="margin-top:30px;" >
            <span class="closebtn" onclick="remove_field(1)">&times;</span> 
            <div class="row">
                <div class="col-md-12">
                    <form method="POST"  enctype="multipart/form-data">
                        <div class="form-group test-in create-form" >
                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control" name="title[]" style="width:90%;">
                            </div>
                            <label for="title" class="col-md-2 col-form-label text-center">{{__('reports.title')}}</label>
                        </div>
                    </form>
                </div>
                <div class="form-group row create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in">
                            <div class="col-md-10">
                                <select class="form-control type" name="type[]" id="type-1" data-label="label-1" style="width:90%;text-align:center">
                                <option value="1">{{__('reports.type_str.1')}}</option>
                                <option value="2">{{__('reports.type_str.2')}}</option>
                                <option value="3">{{__('reports.type_str.3')}}</option>
                                <option value="4">{{__('reports.type_str.4')}}</option>
                                </select>
                            </div>
                            <label for="type" class="col-md-2 col-form-label text-center">{{__('reports.type')}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <form method="POST"  enctype="multipart/form-data">
                        <div class="form-group test-in create-form" >
                            <div class="col-md-10">
                                <input id="label-1" type="text" class="form-control" name="label[]" style="width:90%;">
                            </div>
                            <label for="label-1" class="col-md-2 col-form-label text-center">{{__('reports.label')}}</label>
                        </div>
                    </form>
                </div>
                <div class="form-group create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in">
                            <div class="col-md-10">
                                <form>
                                    <div class="form-group">
                                    <textarea class="form-control" rows="3" id="comment" style="width:90%"></textarea>
                                    </div>
                                </form>
                            </div>
                            <label for="status" class="col-md-2 col-form-label text-center">{{__('reports.description')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <input type="button" onclick="add_field()" class="btn accent-color text-primary-color new-meet" value="{{__('reports.new_field')}}">
    </div>
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
var last_field_index = 1
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
                    "<form method='POST'  enctype='multipart/form-data'>"+
                        "<div class='form-group test-in create-form' >"+
                            "<div class='col-md-10'>"+
                                "<input id='title' type='text' class='form-control' name='title' style='width:90%;'>"+
                            "</div>"+
                            "<label for='title' class='col-md-2 col-form-label text-center'>{{__('reports.title')}}</label>"+
                        "</div>"+
                    "</form>"+
                "</div>"+
                "<div class='form-group row create-form'>"+
                "    <div class='col-md-12'>"+
                "        <div class='form-group test-in'>"+
                "            <div class='col-md-10'>"+
                "                <select class='form-control type' name='type[]' id='type-"+last_field_index+"' data-label='label-"+last_field_index+"' style='width:90%;text-align:center'>"+
                "                <option value='1'>{{__('reports.type_str.1')}}</option>"+
                "                <option value='2'>{{__('reports.type_str.2')}}</option>"+
                "                <option value='3'>{{__('reports.type_str.3')}}</option>"+
                "                <option value='4'>{{__('reports.type_str.4')}}</option>"+
                "                </select>"+
                "            </div>"+
                "            <label for='type' class='col-md-2 col-form-label text-center'>{{__('reports.type')}}</label>"+
                "        </div>"+
                "    </div>"+
                "</div>"+
                "<div class='col-md-12'>"+
                "    <form method='POST'  enctype='multipart/form-data'>"+
                "        <div class='form-group test-in create-form' >"+
                "            <div class='col-md-10'>"+
                "                <input id='label-"+last_field_index+"' type='text' class='form-control' name='label[]' style='width:90%;'>"+
                "            </div>"+
                "            <label for='label-"+last_field_index+"' class='col-md-2 col-form-label text-center'>{{__('reports.label')}}</label>"+
                "        </div>"+
                "    </form>"+
                "</div>"+
                "<div class='form-group create-form'>"+
                    "<div class='col-md-12'>"+
                        "<div class='form-group test-in'>"+
                            "<div class='col-md-10'>"+
                                "<form>"+
                                    "<div class='form-group'>"+
                                    "<textarea class='form-control' rows='3' id='comment' style='width:90%'></textarea>"+
                                    "</div>"+
                                "</form>"+
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