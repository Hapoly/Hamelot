@extends('layouts.print')
@section('title', __('unit_users.index_title'))
@section('content')
    <table>
        <thead>
            <th>{{__('unit_users.row')}}</th>
            <th>{{__('unit_users.user_id')}}</th>
            <th>{{__('unit_users.unit_id')}}</th>
            <th>{{__('unit_users.permission')}}</th>
            <th>{{__('unit_users.status')}}</th>
        </thead>
        <tbody>
            @foreach($unit_users as $index => $unit_user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$unit_user->user->full_name}}</td>
                <td>{{$unit_user->unit->complete_title}}</td>
                <td>{{$unit_user->permission_str}}</td>
                <td>{{$unit_user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection