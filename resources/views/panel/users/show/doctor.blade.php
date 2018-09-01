@extends('layouts.main')
@section('title', $user->first_name . ' ' . $user->last_name)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$user->doctor->profile_url}}" class="center" style="width: 25%">
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
    @if(Auth::user()->isAdmin())
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" role="button">{{__('users.edit.general')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.destroy', ['user' => $user])}}" class="btn btn-danger" role="button">{{__('users.destroy')}}</a>
        </div>
      </div>
    @endif
  </div>
  @if($user->permission_to_departments)
    <div class="panel panel-default">
      <div class="sub-panel-title panel-heading">
        {{__('departments.index_title')}}
      </div>
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
                <td>{{$department->status_str}}</td>
                @if($department->hasEditPermission())
                  <td>
                    <form action="{{route('panel.departments.destroy', ['department' => $department])}}" style="display: inline" method="POST" class="trash-icon">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">{{__('departments.remove')}}</button>
                    </form>
                    <a class="btn btn-primary" href="{{route('panel.departments.edit', ['department' => $department])}}">{{ __('departments.edit') }}</a>
                  </td>
                @else
                  <td>
                    {{__('departments.no_access')}}
                  </td>
                @endif
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
  @endif
</div>
@endsection