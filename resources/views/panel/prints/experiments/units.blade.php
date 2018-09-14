@extends('layouts.print')
@section('title', 'بخش‌های ' . $user->full_name)
@section('content')
    <h3>بخش‌ها</h3>
    <table>
        <thead>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>آدرس</th>
            <th>نوع</th>
            <th>وضعیت نمایش</th>
            <th>شماره تلفن</th>
            <th>شماره همراه</th>
            <th>وضعیت</th>
        </thead>
        <tbody>
            @foreach($user->units as $index => $unit)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$unit->title}}</td>
                <td>{{$unit->address}}</td>
                <td>{{$unit->group_str}}</td>
                <td>{{$unit->public_str}}</td>
                <td>{{$unit->phone_str}}</td>
                <td>{{$unit->mobile_str}}</td>
                <td>{{$unit->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection