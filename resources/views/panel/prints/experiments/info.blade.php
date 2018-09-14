@extends('layouts.print')
@section('title', $user->full_name)
@section('content')
    <table>
        <thead>
            <th style="text-align: center" colspan="4">{{$user->full_name}}</th>
        </thead>
        <tbody>
            <tr>
                <td><b>{{__('users.first_name')}}</b></td>
                <td>{{$user->first_name}}</td>
                <td><b>{{__('users.last_name')}}}</b></td>
                <td>{{$user->last_name}}</td>
            </tr>
            <tr>
                <td><b>{{__('users.group_code')}}</b></td>
                <td>{{$user->group_str}}</td>
                <td><b>{{__('users.status')}}</b></td>
                <td>{{$user->status_str}}</td>
            </tr>
            <tr>
                <td><b>وضعیت نمایش</b></td>
                <td>{{$user->public_str}}</td>
                <td><b>وضعیت کلی</b></td>
                <td>{{$user->status_str}}</td>
            </tr>
        </tbody>
    </table>
    @if($user->visitors())
        <h3>پزشکان و پرستاران</h3>
        <table>
            <thead>
                <th>{{__('users.row')}}</th>
                <th>{{__('users.first_name')}}</th>
                <th>{{__('users.last_name')}}</th>
                <th>{{__('users.group_code')}}</th>
                <th>وضعیت</th>
            </thead>
            <tbody>
                @foreach($user->visitors()->get() as $index => $user)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->status_str}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection