@extends('layouts.print')
@section('title', __('experiments.index_title'))
@section('content')
    <table>
        <thead>
            <th>{{__('experiments.row')}}</th>
            <th>{{__('templates.title')}}</th>
            <th>{{__('experiments.user_id')}}</th>
            <th>{{__('experiments.unit_id')}}</th>
            <th>{{__('experiments.date')}}</th>
            <th>{{__('experiments.status')}}</th>
        </thead>
        <tbody>
            @foreach($experiments as $index => $experiment)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$experiment->report_template->title}}</td>
                <td>{{$experiment->user->full_name}}</td>
                <td>{{$experiment->unit->title}}</td>
                <td>{{$experiment->date_str}}</td>
                <td>{{$experiment->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection