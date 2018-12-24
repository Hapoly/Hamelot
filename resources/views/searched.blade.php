@extends('layouts.app')
@section('title', 'جستجو')
@section('content')
@php
    use App\Models\Entry;
@endphp
<div class="container">
    <div class="form-group search center">
        <form action="{{route('search')}}" method="GET">
            <input type="text" name="term" class="form-control search-input" placeholder="بیمارستان , درمانگاه , پزشک و..." value="{{old('term', $term)}}">
            <button class="btn search-btns">
                جستجو
            </button>
        </form>
    </div>
    <div class="row">
        @foreach($results as $result)
            @switch($result->group_code)
                @case(Entry::HOSPITAL)
                @case(Entry::DEPARTMENT)
                {{ /* @case(Entry::CLINIC) */ }}
                @case(Entry::POLICLINIC)
                @case(Entry::ORTOPED)
                @case(Entry::FIZIOTORAPHY)
                @case(Entry::MASSAGE)
                @case(Entry::WORKOLOGHY)
                    <div class="col-md-4">
                        <div class="searched-card">
                            <img src="{{$result->unit->image_url}}" class="search-img">
                            <h5 class="center">
                                {{$result->unit->complete_title}}
                            </h5>
                            <!-- <div class="star-rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div> -->
                            <span class="center">
                                {{$result->unit->group_str}} ({{$result->unit->type_str}})
                            </span>
                            <span class="center">
                                {{$result->unit->address}}
                            </span>
                            <a href="{{route('show.unit', ['slug' => $result->slug])}}" class="btn see-more-btn center">
                                مشاهده صفحه
                            </a>
                        </div>
                    </div>
                    @break
                @case(Entry::DOCTOR)
                    <div class="col-md-4">
                        <div class="searched-card">
                            <img src="{{$result->user->doctor->profile_url}}" class="search-img">
                            <h5 class="center">
                                {{$result->user->full_name}}
                            </h5>
                            <!-- <div class="star-rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div> -->
                            <span class="center">
                                {{$result->user->field_str}} - {{$result->user->degree_str}}
                            </span>
                            <span class="center">
                                کد نظام‌پزشکی: {{$result->user->msc_str}}
                            </span>
                            <a href="{{route('show.user', ['slug' => $result->slug])}}" class="btn see-more-btn center">
                                مشاهده صفحه
                            </a>
                        </div>
                    </div>
                @break
                @case(Entry::NURSE)
                    <div class="col-md-4">
                        <div class="searched-card">
                            <img src="{{$result->user->nurse->profile_url}}" class="search-img">
                            <h5 class="center">
                                {{$result->user->full_name}}
                            </h5>
                            <!-- <div class="star-rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div> -->
                            <span class="center">
                                {{$result->user->field_str}} - {{$result->user->degree_str}}
                            </span>
                            <span class="center">
                                کد نظام‌پزشکی: {{$result->user->msc_str}}
                            </span>
                            <a href="{{route('show.user', ['slug' => $result->slug])}}" class="btn see-more-btn center">
                                مشاهده صفحه
                            </a>
                        </div>
                    </div>
                @break
            @endswitch
        @endforeach
        <!-- <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پرستار
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پرستار
                </span>
                <span class="center">
                        کد نظام پرستاری
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/loc.jpg" class="search-img">
                <h5 class="center">
                عنوان واحد درمانی
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                نوع واحد درمانی
                </span>
                <span class="center">
                آدرس و یا توضیحات
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
         <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
         <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searched-card">
                <img src="/imgs/img.png" class="search-img">
                <h5 class="center">
                        نام و نام خانوادگی پزشک
                </h5>
                <div class="star-rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="center">
                        فیلد کاری و تخصص پزشک
                </span>
                <span class="center">
                        کد نظام پزشکی
                </span>
                <button class="btn see-more-btn center">
                    مشاهده صفحه
                </button>
            </div>
        </div> -->
    </div>
    <div class="center">
        {{$results->links()}}
    </div>
</div>
@endsection