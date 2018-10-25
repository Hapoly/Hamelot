@extends('layouts.app')
@section('title', $user->full_name)
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
                                    <td>{{__('users.first_name')}}</td>
                                    <td>{{$user->first_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('users.last_name')}}</td>
                                    <td>{{$user->last_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('users.degree')}}</td>
                                    <td>{{$user->degree_str}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('users.field')}}</td>
                                    <td>{{$user->field_str}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('users.msc')}}</td>
                                    <td>{{$user->msc_str}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('users.gender')}}</td>
                                    <td>{{$user->gender_str}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5" style="text-align: center; padding: 5px">
                        @if($user->isDoctor())
                            <img src="{{$user->doctor->profile_url}}" />
                        @elseif($user->isNurse())
                            <img src="{{$user->nurse->profile_url}}" />
                        @endif
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
                                        <td>{{__('general.day_of_week.' . $i)}} - {{$user->activity_times[$i]['date']}}</td>
                                        <td>
                                            @php
                                                $day = $user->activity_times[$i]['day'];
                                            @endphp
                                            @foreach($user->activity_times[$i]['times'] as $time)
                                                <a class="primary-btn" href="{{route('panel.demands.create.visit', ['activity_time' => $time, 'day' => $day])}}">{{$time->day_less_time_str}} ({{$time->unit_user->unit->complete_title}})</a>
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
                            <a href="{{route("show.user", ['username' => $user->username, 'time' => ($offset - (7*24*3600))])}}" class="default-btn">هفته قبل</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <a href="{{route("show.user", ['username' => $user->username, 'time' => ($offset + (7*24*3600))])}}" class="default-btn">هفته بعد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection