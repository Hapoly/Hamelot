@extends('layouts.app')
@section('title', $user->first_name . ' ' . $user->last_name)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $user->first_name }} {{ $user->last_name }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$user->username}}</div>
            <div class="col-md-3">:{{__('users.username')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->first_name}}</div>
            <div class="col-md-3">:{{__('users.first_name')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->last_name}}</div>
            <div class="col-md-3">:{{__('users.last_name')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->prefix}}</div>
            <div class="col-md-3">:{{__('users.prefix')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->group_code_str()}}</div>
            <div class="col-md-3">:{{__('users.group_code')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$user->status_str()}}</div>
            <div class="col-md-3">:{{__('users.status')}}</div>
          </div>
          <div class="row">
            <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit')}}</a>
            <form action="{{route('panel.users.destroy', ['user' => $user])}}" method="post">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger">حذف</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if($user->group_code == \App\User::G_MANAGER)
      <div class="col-md-8" style="margin-top: 1rem">
        <a href="{{route('panel.hospital_users.create')}}" class="btn btn-info" role="button">{{__('hospital_users.create')}}</a>
      </div>
      <div class="col-md-8" style="margin-top: 1rem">
        <div class="card">
          <div class="card-header">{{__('hospitals.index_title')}}</div>
          <div class="card-body">
            @if(sizeof($user->hospitals))
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>{{__('hospital_users.row')}}</th>
                    <th>{{__('hospital_users.hospital_id')}}</th>
                    <th>{{__('hospital_users.operation')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->hospitals as $hospital_user)
                    <tr>
                      <td>{{$hospital_user->hospital->id}}</td>
                      <td><a href="{{route('panel.hospitals.show', ['hospital_user' => $hospital_user])}}">{{$hospital_user->hospital->title}}</a></td>
                      <td>
                        <form action="{{route('panel.hospital_users.destroy', ['hospital_user' => $hospital_user])}}" style="display: inline" method="POST" class="trash-icon">
                          {{ method_field('DELETE') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger">{{__('hospital_users.remove')}}</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="row">
                <div class="col-md-12" style="text-align: center">
                  {{__('hospital_users.not_found')}}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    @endif
    @if($user->group_code == \App\User::G_DOCTOR || $user->group_code == \App\User::G_NURSE)
      <div class="col-md-8" style="margin-top: 1rem">
        <a href="{{route('panel.department_users.create')}}" class="btn btn-info" role="button">{{__('department_users.create')}}</a>
      </div>
      <div class="col-md-8" style="margin-top: 1rem">
        <div class="card">
          <div class="card-header">{{__('departments.index_title')}}</div>
          <div class="card-body">
            @if(sizeof($user->departments))
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>{{__('department_users.row')}}</th>
                    <th>{{__('department_users.department_id')}}</th>
                    <th>{{__('department_users.operation')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->departments as $department_user)
                    <tr>
                      <td>{{$department_user->department->id}}</td>
                      <td><a href="{{route('panel.departments.show', ['department_user' => $department_user])}}">{{$department_user->department->title}}</a></td>
                      <td>
                        <form action="{{route('panel.department_users.destroy', ['department_user' => $department_user])}}" style="display: inline" method="POST" class="trash-icon">
                          {{ method_field('DELETE') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger">{{__('department_users.remove')}}</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="row">
                <div class="col-md-12" style="text-align: center">
                  {{__('department_users.not_found')}}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
