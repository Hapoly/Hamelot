@extends('layouts.print')
@section('title', 'بیمارستان‌ها')
@section('content')
    <table>
        <thead>
            <th>{{__('units.row')}}</th>
            <th>{{__('units.title')}}</th>
            <th>{{__('units.group_code')}}</th>
            <th>{{__('units.province_id')}}</th>
            <th>{{__('units.city_id')}}</th>
            <th>{{__('units.address')}}</th>
            <th>{{__('units.status')}}</th>
        </thead>
        <tbody>
            @foreach($units as $index => $unit)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$unit->title}}</td>
                <td>{{$unit->group_str}}</td>
                <td>{{$unit->city->province->title}}</td>
                <td>{{$unit->city->title}}</td>
                <td>{{$unit->address}}</td>
                <td>{{$unit->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection