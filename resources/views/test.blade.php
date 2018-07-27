@extends('layouts.main')
@section('title', __('tests.index.title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="" method="get">
                <div class="input-group add-on">
                <div class="input-group-btn">
                    <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
                <input class="form-control search-box" placeholder=""  name="search" id="srch-term" value="" type="text">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection