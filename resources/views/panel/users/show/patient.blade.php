@extends('layouts.main')
@section('title', $user->first_name_str . ' ' . $user->last_name_str)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$user->patient->profile_url}}" class="center" style="width: 25%">
    </div>
    <div class="row">
      <h2>{{ $user->first_name_str }} {{ $user->last_name_str }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('users.first_name')}}</td>
            <td>{{$user->first_name_str}}</td>
          </tr>
          <tr>
            <td>{{__('users.last_name')}}</td>
            <td>{{$user->last_name_str}}</td>
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
          @if(Auth::user()->isAdmin())
            <tr>
              <td>{{__('users.phone')}}</td>
              <td>{{$user->phone}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    @if(Auth::user()->isAdmin())
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary" id="edit" role="button">{{__('users.edit.general')}}</a>
          @if(Auth::user()->isDoctor())
            <a href="{{route('panel.permissions.create', ['user' => $user])}}" class="btn btn-primary" id="permission_create" role="button">{{__('permissions.create')}}</a>
          @endif
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.destroy', ['user' => $user])}}" id="remove" class="btn btn-danger" role="button">{{__('users.remove')}}</a>
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
  @if(Auth::user()->isAdmin() || Auth::user()->id == $user->id)
    <div class="panel panel-default">
      <h2>{{__('permissions.index_title')}}</h2>
      @tagline{{__('permissions.tag_line_patients')}}@endtagline
      @if(sizeof($user->visitors))
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
            @foreach($user->visitors as $index => $visitor)
              <tr>
                <td>{{$index}}</td>
                <td><a href="{{route('panel.users.show', ['user' => $visitor])}}">{{$visitor->full_name}}</a></td>
                <td>{{$visitor->group_str}}</td>
                <td>{{$visitor->status_str}}</td>
                @if(Auth::user()->isAdmin())
                  <td>
                    @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $visitor, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
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
  @endif
  <div class="panel panel-default">
    <h2>{{__('experiments.index_title')}}</h2>
    @tagline{{__('experiments.tag_line_patients')}}@endtagline
    @if(sizeof($user->experiments))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('experiments.row')}}</th>
            <th>{{__('experiments.title')}}</th>
            <th>{{__('experiments.user_id')}}</th>
            <th>{{__('experiments.status')}}</th>
            <th>{{__('experiments.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->experiments as $experiment)
            <tr>
              <td>{{$experiment->id}}</td>
              <td><a href="{{route('panel.report_templates.show', ['report_template' => $experiment->report_template])}}">{{$experiment->report_template->title}}</a></td>
              <td>{{$experiment->user->full_name}}</td>
              <td>{{$experiment->status_str}}</td>
              @if(Auth::user()->isAdmin())
                <td>
                  @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $experiment, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
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
          {{__('experiments.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection