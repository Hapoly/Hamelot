@extends('layouts.print')
@section('title', 'کاربران')
@section('content')
    <table>
        <thead>
            <th>ردیف</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>گروه کاربری</th>
            <th>شماره شناسنامه</th>
            <th>سن</th>
            <th>سطح علمی</th>
            <th>تخصص</th>
            <th>کد نظام پزشکی/پرستاری</th>
            <th>وضعیت</th>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
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