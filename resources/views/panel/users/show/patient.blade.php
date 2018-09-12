@extends('layouts.main')
@section('title', $user->first_name . ' ' . $user->last_name)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$user->patient->profile_url}}" class="center" style="width: 25%">
    </div>
    <div class="row">
      <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('users.first_name')}}</td>
            <td>{{$user->first_name}}</td>
          </tr>
          <tr>
            <td>{{__('users.last_name')}}</td>
            <td>{{$user->last_name}}</td>
          </tr>
          <tr>
            <td>{{__('users.id_number')}}</td>
            <td>{{$user->patient->id_number}}</td>
          </tr>
          <tr>
            <td>{{__('users.status')}}</td>
            <td>{{$user->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.gender')}}</td>
            <td>{{$user->patient->gender_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.birth_date')}}</td>
            <td>{{$user->patient->birth_date_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.age')}}</td>
            <td>{{$user->patient->age_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if(Auth::user()->isAdmin())
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
          @if(Auth::user()->isDoctor())
            <a href="{{route('panel.permissions.create', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('permissions.create')}}</a>
          @endif
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <h2>{{__('units.index_title')}}</h2>
    @tagline{{__('units.tag_line_patient')}}@endtagline
    @if(sizeof($user->units))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('units.row')}}</th>
            <th>{{__('units.title')}}</th>
            <th>{{__('units.hospital_id')}}</th>
            <th>{{__('units.status')}}</th>
            <th>{{__('units.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->units as $unit)
            <tr>
              <td>{{$unit->id}}</td>
              <td><a href="{{route('panel.units.show', ['unit' => $unit])}}">{{$unit->title}}</a></td>
              <td><a href="{{route('panel.hospitals.show', ['hospital' => $unit->hospital])}}">{{$unit->hospital->title}}</a></td>
              <td>{{$unit->status_str}}</td>
              @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                <td>
                  <form action="{{route('panel.units.destroy', ['unit' => $unit])}}" style="display: inline" method="POST" class="trash-icon">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">{{__('units.remove')}}</button>
                  </form>
                </td>
              @else
                <td>-</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('units.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection