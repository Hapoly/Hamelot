@extends('layouts.print')
@section('title', 'بخش‌های ' . $unit->title)
@section('content')
    <table>
        <thead>
            <th style="text-align: center" colspan="4">{{$unit->title}}</th>
        </thead>
        <tbody>
            <tr>
                <td><b>واحد مادر</b></td>
                <td>{{$unit->parent? $unit->parent->title: 'ریشه'}}</td>
                <td><b>نوع واحد</b></td>
                <td>{{$unit->group_str}}</td>
            </tr>
            <tr>
                <td><b>شماره تلفن</b></td>
                <td>{{$unit->phone_str}}</td>
                <td><b>شماره همراه</b></td>
                <td>{{$unit->mobile_str}}</td>
            </tr>
            <tr>
                <td><b>وضعیت نمایش</b></td>
                <td>{{$unit->type_str}}</td>
                <td><b>وضعیت کلی</b></td>
                <td>{{$unit->status_str}}</td>
            </tr>
            <tr>
                <td><b>شهر</b></td>
                <td>{{$unit->city->title}}</td>
                <td><b>استان</b></td>
                <td>{{$unit->city->province->title}}</td>
            </tr>
            <tr>
                <td colspan="1"><b>آدرس</b></td>
                <td colspan="3">{{$unit->address}}</td>
            </tr>
        </tbody>
    </table>
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