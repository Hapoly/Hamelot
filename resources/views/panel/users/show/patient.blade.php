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
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.info', ['user' => $user])}}">{{__('users.print_info')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.experiments', ['user' => $user])}}">{{__('users.print_experiments')}}</a>
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.visitors', ['user' => $user])}}">{{__('users.print_visitors')}}</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <h2>{{__('permissions.index_title')}}</h2>
    @tagline{{__('permissions.tag_line_patients')}}@endtagline
    @if(sizeof($user->visitors()))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('permissions.row')}}</th>
            <th>{{__('permissions.requester_id')}}</th>
            <th>{{__('users.group_code')}}</th>
            <th>{{__('permissions.status')}}</th>
            <th>{{__('permissions.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->visitors()->get() as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td><a href="{{route('panel.users.show', ['user' => $user])}}">{{$user->full_name}}</a></td>
              <td>{{$user->group_str}}</td>
              <td>{{$user->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                  @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
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
          {{__('permissions.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection