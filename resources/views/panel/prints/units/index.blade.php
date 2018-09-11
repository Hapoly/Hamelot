@extends('layouts.print')
@section('title', 'بیمارستان‌ها')
@section('content')
    <table>
        <thead>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>استان</th>
            <th>شهر</th>
            <th>آدرس</th>
            <th>وضعیت</th>
        </thead>
        <tbody>
            @foreach($units as $index => $unit)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$unit->title}}</td>
                <td>{{$unit->city->province->title}}</td>
                <td>{{$unit->city->title}}</td>
                <td>{{$unit->address}}</td>
                <td>{{$unit->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection