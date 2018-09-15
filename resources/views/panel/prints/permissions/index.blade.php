@extends('layouts.print')
@section('title', __('permissions.index_title'))
@section('content')
    <table>
        <thead>
            <th>{{__('permissions.row')}}</th>
            <th>{{__('permissions.requester_id')}}</th>
            <th>{{__('permissions.patient_id')}}</th>
            <th>{{__('permissions.status')}}</th>
        </thead>
        <tbody>
            @foreach($permissions as $index => $permission)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$permission->requester->full_name}}</td>
                <td>{{$permission->patient->full_name}}</td>
                <td>{{$permission->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection