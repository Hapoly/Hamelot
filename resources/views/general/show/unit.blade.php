@extends('layouts.app')
@section('title', $unit->complete_title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="show-card">
                <div class="row">
                    <div class="col-md-7">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>{{__('units.title')}}</td>
                                    <td>{{$unit->complete_title}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('units.address')}}</td>
                                    <td>{{$unit->address}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('units.province_id')}}</td>
                                    <td>{{$unit->city->province->title}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('units.city_id')}}</td>
                                    <td>{{$unit->city->title}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('units.group_code')}}</td>
                                    <td>{{$unit->group_str}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5" style="text-align: center; padding: 5px">
                        <img src="{{$unit->image_url}}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <th>روز هفته</th>
                                <th colspan="5">ساعت کاری</th>
                            </thead>
                            <tbody>
                                @for($i=1; $i<=7; $i++)
                                    <tr>
                                        <td>{{__('general.day_of_week.' . $i)}} - {{$unit->activity_times[$i]['date']}}</td>
                                        <td>
                                            @php
                                                $day = $unit->activity_times[$i]['day'];
                                            @endphp
                                            @foreach($unit->activity_times[$i]['times'] as $time)
                                                <a class="primary-btn" href="{{route('panel.demands.create.visit', ['activity_time' => $time, 'day' => $day])}}">{{$time->day_less_time_str}}</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="text-align: right">
                        @if($offset <= time())
                            <a class="default-btn">هفته قبل</a>
                        @else
                            <a href="{{route("show.unit", ['slug' => $unit->slug, 'time' => ($offset - (7*24*3600))])}}" class="default-btn">هفته قبل</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <a href="{{route("show.unit", ['slug' => $unit->slug, 'time' => ($offset + (7*24*3600))])}}" class="default-btn">هفته بعد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection