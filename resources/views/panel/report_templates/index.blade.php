@extends('layouts.main')
@section('title', __('reports.index'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
  <a href="{{route('panel.report_templates.create')}}" class="btn add"> قالب جدید</a>
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.report_templates.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('reports.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @if(sizeof($report_templates))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th ><a href="{{route('panel.report_templates.index',['search' => $search,'sort' => 'id'    ,'page' => $report_templates->currentPage()])}}">{{__('reports.row')}}</a></th>
          <th ><a href="{{route('panel.report_templates.index',['search' => $search,'sort' => 'title'    ,'page' => $report_templates->currentPage()])}}">{{__('reports.title')}}</a></th>
          <th ><a href="{{route('panel.report_templates.index',['search' => $search,'sort' => 'field_count'    ,'page' => $report_templates->currentPage()])}}">{{__('reports.field_count')}}</a></th>
          <th ><a href="{{route('panel.report_templates.index',['search' => $search,'sort' => 'status'    ,'page' => $report_templates->currentPage()])}}">{{__('reports.status')}}</a></th>
          @if(Auth::user()->isAdmin())
            <th >{{__('reports.operation')}}</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($report_templates as $report_template)
          <tr>
          <td>{{$report_template->id}}</td>
          <td><a href="{{route('panel.report_templates.show', ['report_template' => $report_template])}}">{{$report_template->title}}</a></td>
          <td>{{$report_template->field_count}}</td>
          <td>{{$report_template->status_str}}</td>
          @if(Auth::user()->isAdmin())
            <td>
              <form action="{{route('panel.report_templates.destroy', ['report_template' => $report_template])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('reports.remove')}}</button>
              </form>
              <a href="{{route('panel.report_templates.edit', ['report_template' => $report_template])}}" class="btn btn-info" role="button">{{__('reports.edit')}}</a>
            </td>
          @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        {{__('reports.not_found')}}
      </div>
    </div>
  @endif
  <div class="container" style="text-align:center;margin-top:30px;">
    {{$report_templates->links()}}
  </div>
</div>
@endsection
