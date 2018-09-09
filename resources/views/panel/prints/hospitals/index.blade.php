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
            @foreach($hospitals as $index => $hospital)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$hospital->title}}</td>
                <td>{{$hospital->city->province->title}}</td>
                <td>{{$hospital->city->title}}</td>
                <td>{{$hospital->address}}</td>
                <td>{{$hospital->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection