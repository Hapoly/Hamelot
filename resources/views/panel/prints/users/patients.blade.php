@extends('layouts.print')
@section('title', 'بیماران ' . $user->full_name)
@section('content')
    <h3>بیماران</h3>
    <table>
        <thead>
            <th>ردیف</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>وضعیت</th>
        </thead>
        <tbody>
            @foreach($user->patients()->get() as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$user->first_name_str}}</td>
                <td>{{$user->last_name_str}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection