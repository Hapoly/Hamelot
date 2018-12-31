@extends('layouts.app')
@section('title', 'خانه')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-things">
                <img src="{{asset('/imgs/512.png')}}">
                <h2 style="padding-top:20px;padding-bottom:60px;">
                نوبت دهی دکتر سوال
                </h2>
                <form action="{{route('search')}}" method="GET">
                    <div class="row">
                        <div class="col-md-3 select-col">
                            <select name="city_id" class="form-control search-select" title="انتخاب شهر">
                                <option value="0">همه شهرها</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9">
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
                                    <button type="submit" class="btn search-btns" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="flex-container">
                    
                    <div class="icons">
                        <a href="{{route('search', ['group_code' => 6])}}">
                            <div class="circle-icon">
                                <img src="{{asset('/imgs/icon/hospital.svg')}}">
                            </div>
                            مطب ها
                        </a>
                    </div>
                    <div class="icons">
                        <a href="{{route('search', ['group_code' => 9])}}">
                            <div class="circle-icon">
                                <img src="{{asset('/imgs/icon/fiziyo.svg')}}">
                            </div>
                            مراکز فیزیوتراپی 
                        </a>
                    </div>
                    <div class="icons">
                        <a href="{{route('search', ['group_code' => 8])}}">
                            <div class="circle-icon">
                                <img src="{{asset('/imgs/icon/ortoped.svg')}}">
                            </div>
                            مرکز ارتوپدی
                        </a>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection