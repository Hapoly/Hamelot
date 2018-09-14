@extends('layouts.print')
@section('title', 'کاربران')
@section('content')
    <table>
        <thead>
            <th>{{__('users.row')}}</th>
            @if(Auth::user()->isAdmin())
                <th>{{__('users.username')}}</th>
            @endif
            <th>{{__('users.first_name')}}</th>
            <th>{{__('users.last_name')}}</th>
            <th>{{__('users.group_code')}}</th>
            <th>{{__('users.id_number')}}</th>
            <th>{{__('users.age')}}</th>
            <th>{{__('users.degree')}}</th>
            <th>{{__('users.field')}}</th>
            <th>{{__('users.msc')}}</th>
            <th>{{__('users.status')}}</th>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                @if(Auth::user()->isAdmin())
                    <td>{{$user->username}}</td>
                @endif
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->group_str}}</td>
                <td>{{$user->id_number}}</td>
                <td>{{$user->age_str}}</td>
                <td>{{$user->degree_str}}</td>
                <td>{{$user->field_str}}</td>
                <td>{{$user->msc_str}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection