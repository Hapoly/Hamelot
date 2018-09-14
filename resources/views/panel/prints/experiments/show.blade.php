@extends('layouts.print')
@section('title', 'آزمایش ' . $experiment->report_template->title . ' ' . $experiment->user->full_name)
@section('content')
    <h3>{{'آزمایش ' . $experiment->report_template->title . ' ' . $experiment->user->full_name}}</h3>
    <table>
        <tbody>
            @foreach($experiment->fields as $field)
                <tr>
                    <td>{{$field->title}}</td>
                    <td>{{$field->literal_value}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection