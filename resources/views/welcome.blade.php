@extends('layouts.app')
@section('title', 'خانه')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-things">
                <img src="{{asset('/imgs/512.png')}}">
                <h2 style="padding-top:20px;padding-bottom:20px;">
                نوبت دهی دکتر سوال
                </h2>
                <form action="{{route('search')}}" method="GET">
                    <!-- <div class="form-group" style="padding-top:25px">
                        <input type="text" name="term" class="form-control search-input" style="width:80%;" 
                        placeholder="جستجوی  پزشک ، بیمارستان ، درمانگاه  ">
                    </div>
                    <button type="submit" class="btn search-btns">
                        جستجو
                    </button> -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="جستجوی  پزشک ، بیمارستان ، درمانگاه  ">
                        <div class="input-group-append">
                        <button class="btn search-btns" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection