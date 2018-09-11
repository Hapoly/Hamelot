@extends('layouts.print')
@section('title', 'پرسنل ' . $unit->title)
@section('content')
    <h3>کادر مدیریت</h3>
    <table>
        <thead>
            <th>ردیف</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>وضعیت</th>
        </thead>
        <tbody>
            @foreach($unit->managers as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>کادر سلامت</h3>
    <table>
        <thead>
            <th>ردیف</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>گروه کاربری</th>
            <th>سطح علمی</th>
            <th>تخصص</th>
            <th>وضعیت</th>
        </thead>
        <tbody>
            @foreach($unit->members as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->group_str}}</td>
                <td>{{$user->degree_str}}</td>
                <td>{{$user->field_str}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection