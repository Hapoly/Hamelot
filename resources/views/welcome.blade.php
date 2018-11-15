@extends('layouts.app')
@section('title', 'خانه')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-things">
                <img src="{{asset('/imgs/logo.png')}}">
                <form action="{{route('search')}}" method="GET">
                    <div class="form-group" style="padding-top:25px">
                        <input type="text" name="term" class="form-control search-input" style="width:80%;" placeholder="بیمارستان , درمانگاه , پزشک و...">
                    </div>
                    <button type="submit" class="btn search-btns">
                        جستجو
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection