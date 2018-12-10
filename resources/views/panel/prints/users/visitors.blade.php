@extends('layouts.print')
@section('title', 'پزشکان و پرستاران ' . $user->full_name)
@section('content')
    <h3>{{__('users.visitors')}}</h3>
    <table>
        <thead>
            <th>{{__('users.row')}}</th>
            <th>{{__('users.first_name')}}</th>
            <th>{{__('users.last_name')}}</th>
            <th>{{__('users.group_code')}}</th>
            <th>{{__('users.status')}}</th>
        </thead>
        <tbody>
            @foreach($user->visitors()->get() as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$user->first_name_str}}</td>
                <td>{{$user->last_name_str}}</td>
                <td>{{$user->group_str}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection