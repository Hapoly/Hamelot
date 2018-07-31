@extends('layouts.main')
@section('title', __('tests.index.title'))
@section('content')
<div class="test">
<!-- <div class="row" style="margin-bottom:50px;">
    
    <div class="col-md-8 col-sm-9">
        <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.test')}}" method="get">
            <div class="input-group add-on">
            <div class="input-group-btn">
                <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
            <input class="form-control search-box" placeholder=""  name="search" id="srch-term" value="" type="text">
            </div>
        </form>
    </div>
</div> -->
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
                            <label for="title" class="col-md-2 col-form-label text-center">عنوان</label>
                        </div>
                    </form>
                </div>
                <div class="form-group row create-form">
                    <div class="col-md-12">
                        <div class="form-group test-in">
                            <div class="col-md-10">
                                <select class="form-control" name="status" id="status" style="width:90%;text-align:center">
                                <option value="1">13  </option>
                                <option value="2">15 </option>
                                </select>
                            </div>
                            <label for="status" class="col-md-2 col-form-label text-center">نوع</label>
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
                            <label for="status" class="col-md-2 col-form-label text-center">توضیحات</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="button" onclick="add_time()" class="btn accent-color text-primary-color new-meet" value="جلسه جدید">
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
                            "<label for='title' class='col-md-2 col-form-label text-center'>عنوان</label>"+
                        "</div>"+
                    "</form>"+
                "</div>"+
                "<div class='form-group row create-form'>"+
                    "<div class='col-md-12'>"+
                        "<div class='form-group test-in'>"+
                            "<div class='col-md-10'>"+
                                "<select class='form-control' name='status' id='status' style='width:90%;text-align:center'>"+
                                "<option value='1'>13  </option>"+
                                "<option value='2'>15 </option>"+
                                "</select>"+
                            "</div>"+
                            "<label for='status' class='col-md-2 col-form-label text-center'>نوع</label>"+
                        "</div>"+
                    "</div>"+
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
                            "<label for='status' class='col-md-2 col-form-label text-center'>توضیحات</label>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
            "</div>"+
            "<div class='row'>"+
                "<input type='button' onclick='add_time()' class='btn accent-color text-primary-color new-meet' value='جلسه جدید'>"+
            "</div>"+
        "</div>"
    )
}
</script>
@endsection