@extends('layouts.print')
@section('title', 'بخش‌های ' . $unit->title)
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
            @foreach($unit->sub_units as $index => $sub_unit)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$sub_unit->title}}</td>
                <td>{{$sub_unit->address}}</td>
                <td>{{$sub_unit->group_str}}</td>
                <td>{{$sub_unit->public_str}}</td>
                <td>{{$sub_unit->phone_str}}</td>
                <td>{{$sub_unit->mobile_str}}</td>
                <td>{{$sub_unit->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection