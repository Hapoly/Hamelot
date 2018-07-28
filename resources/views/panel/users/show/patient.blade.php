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
    <h2>{{__('departments.index_title')}}</h2>
    @if(sizeof($user->departments))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('departments.row')}}</th>
            <th>{{__('departments.title')}}</th>
            <th>{{__('departments.status')}}</th>
            <th>{{__('departments.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->departments as $department)
            <tr>
              <td>{{$department->id}}</td>
              <td><a href="{{route('panel.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
              <td>{{$department->status_str()}}</td>
              <td>
                <form action="{{route('panel.departments.destroy', ['department' => $department])}}" style="display: inline" method="POST" class="trash-icon">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">{{__('departments.remove')}}</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('departments.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection