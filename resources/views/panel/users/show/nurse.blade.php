@extends('layouts.main')
@section('title', $user->first_name . ' ' . $user->last_name)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$user->nurse->profile_url}}" class="center" style="width: 25%">
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
            <td>{{__('users.status')}}</td>
            <td>{{$user->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.field')}}</td>
            <td>{{$user->field_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.degree')}}</td>
            <td>{{$user->degree_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.msc')}}</td>
            <td>{{$user->msc_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <h2>{{__('units.index_title')}}</h2>
    @if(sizeof($user->units))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('units.row')}}</th>
            <th>{{__('units.title')}}</th>
            <th>{{__('units.status')}}</th>
            <th>{{__('units.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->units as $unit)
            <tr>
              <td>{{$unit->id}}</td>
              <td><a href="{{route('panel.units.show', ['unit' => $unit])}}">{{$unit->title}}</a></td>
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