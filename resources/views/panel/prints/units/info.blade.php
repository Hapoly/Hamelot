@extends('layouts.print')
@section('title', $unit->group_str . ' ' . $unit->title)
@section('content')
    <table>
        <thead>
            <th style="text-align: center" colspan="4">{{$unit->title}}</th>
        </thead>
        <tbody>
            <tr>
                <td><b>{{__('units.parent_id')}}</b></td>
                <td>{{$unit->parent? $unit->parent->title: 'ریشه'}}</td>
                <td><b>{{__('units.group_code')}}</b></td>
                <td>{{$unit->group_str}}</td>
            </tr>
            <tr>
                <td><b>{{__('units.phone')}}</b></td>
                <td>{{$unit->phone_str}}</td>
                <td><b>{{__('units.mobile')}}</b></td>
                <td>{{$unit->mobile_str}}</td>
            </tr>
            <tr>
                <td><b>{{__('units.type')}}</b></td>
                <td>{{$unit->type_str}}</td>
                <td><b>{{__('units.status')}}</b></td>
                <td>{{$unit->status_str}}</td>
            </tr>
            <tr>
                <td><b>{{__('units.city_id')}}</b></td>
                <td>{{$unit->city->title}}</td>
                <td><b>{{__('units.province_id')}}</b></td>
                <td>{{$unit->city->province->title}}</td>
            </tr>
            <tr>
                <td colspan="1"><b>{{__('units.address')}}</b></td>
                <td colspan="3">{{$unit->address}}</td>
            </tr>
        </tbody>
    </table>
    <h3>{{__('units.managers')}}</h3>
    <table>
        <thead>
            <th>{{__('users.row')}}</th>
            <th>{{__('users.first_name')}}</th>
            <th>{{__('users.last_name')}}</th>
            <th>{{__('users.status')}}</th>
        </thead>
        <tbody>
            @foreach($unit->managers as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$user->first_name_str}}</td>
                <td>{{$user->last_name_str}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>{{__('units.members')}}</h3>
    <table>
        <thead>
            <th>{{__('users.row')}}</th>
            <th>{{__('users.first_name')}}</th>
            <th>{{__('users.last_name')}}</th>
            <th>{{__('users.group_code')}}</th>
            <th>{{__('users.degree')}}</th>
            <th>{{__('users.field')}}</th>
                <td>{{$user->status_str}}</td>
        </thead>
        <tbody>
            @foreach($unit->members as $index => $user)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$user->first_name_str}}</td>
                <td>{{$user->last_name_str}}</td>
                <td>{{$user->group_str}}</td>
                <td>{{$user->degree_str}}</td>
                <td>{{$user->field_str}}</td>
                <td>{{$user->status_str}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>{{__('units.index_title')}}</h3>
    <table>
        <thead>
            <th>{{__('units.row')}}</th>
            <th>{{__('units.title')}}</th>
            <th>{{__('units.address')}}</th>
            <th>{{__('units.group_code')}}</th>
            <th>{{__('units.type')}}</th>
            <th>{{__('units.phone')}}</th>
            <th>{{__('units.mobile')}}</th>
            <th>{{__('units.status')}}</th>
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