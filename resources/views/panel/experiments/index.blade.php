@extends('layouts.main')
@section('title', __('experiments.index'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
  <a href="{{route('panel.experiments.create')}}" class="btn add"> قالب جدید</a>
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.experiments.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('experiments.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @if(sizeof($experiments))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th >{{__('experiments.row')}}</th>
          <th >{{__('experiments.title')}}</th>
          <th >{{__('experiments.user_id')}}</th>
          <th >{{__('experiments.date')}}</th>
          <th >{{__('experiments.unit_id')}}</th>
          @if(Auth::user()->isAdmin())
            <th >{{__('experiments.operation')}}</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($experiments as $experiment)
          <tr>
          <td>{{$experiment->id}}</td>
          <td><a href="{{route('panel.experiments.show', ['experiment' => $experiment])}}">{{$experiment->report_template->title}}</a></td>
          <td><a href="{{route('panel.users.show', ['user' => $experiment->user])}}">{{$experiment->user->full_name}}</a></td>
          <td>{{$experiment->date_str}}</td>
          <td>{{$experiment->unit->title}}</td>
          @if(Auth::user()->isAdmin())
            <td>
              <form action="{{route('panel.experiments.destroy', ['experiment' => $experiment])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('experiments.remove')}}</button>
              </form>
              <a href="{{route('panel.experiments.edit', ['experiment' => $experiment])}}" class="btn btn-info" role="button">{{__('experiments.edit')}}</a>
            </td>
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
  @pagination(['links' => $experiments->links()])
</div>
@endsection
