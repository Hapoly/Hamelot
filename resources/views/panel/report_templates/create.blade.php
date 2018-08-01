@extends('layouts.main')
@section('title', __('reports.create'))
@section('content')
<div class="test">
    <form id="times">
        <div class="panel panel-default create-card"  style="margin-top:30px;" >
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <div class="row">
                <div class="col-md-12">
                    <form method="POST"  enctype="multipart/form-data">
                        <div class="form-group test-in create-form" >
                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control" name="title" style="width:90%;">
                            </div>
                            <label for="title" class="col-md-2 col-form-label text-center">{{__('reports.title')}}</label>
                        </div>
                    </form>
                </div>
                <div class="form-group row create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in">
                            <div class="col-md-10">
                                <select class="form-control" name="status" id="status" style="width:90%;text-align:center">
                                <option value="1">{{__('reports.type_str.1')}}</option>
                                <option value="2">{{__('reports.type_str.2')}}</option>
                                <option value="3">{{__('reports.type_str.3')}}</option>
                                <option value="3">{{__('reports.type_str.4')}}</option>
                                </select>
                            </div>
                            <label for="status" class="col-md-2 col-form-label text-center">{{__('reports.type')}}</label>
                        </div>
                    </div>
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
            <div class="row">
                <input type="button" onclick="add_time()" class="btn accent-color text-primary-color new-meet" value="{{__('reports.new_field')}}">
            </div>
        </div>
    </form>
</div>
<script>
function add_time(){
    $("#times").append(
        "<div class='panel panel-default create-card'  style='margin-top:30px;' >"+
            "<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>"+ 
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
                "                <select class='form-control' name='status' id='status' style='width:90%;text-align:center'>"+
                "                <option value='1'>{{__('reports.type_str.1')}}</option>"+
                "                <option value='2'>{{__('reports.type_str.2')}}</option>"+
                "                <option value='3'>{{__('reports.type_str.3')}}</option>"+
                "                <option value='3'>{{__('reports.type_str.4')}}</option>"+
                "                </select>"+
                "            </div>"+
                "            <label for='status' class='col-md-2 col-form-label text-center'>{{__('reports.type')}}</label>"+
                "        </div>"+
                "    </div>"+
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
            "<div class='row'>"+
                "<input type='button' onclick='add_time()' class='btn accent-color text-primary-color new-meet' value='{{__('reports.new_field')}}'>"+
            "</div>"+
        "</div>"
    )
}
</script>
@endsection