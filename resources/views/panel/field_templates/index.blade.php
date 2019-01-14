@extends('layouts.main')
@section('title', __('reports.index'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
  @if(Auth::user()->isAdmin())
     <a href="{{route('panel.field_templates.create')}}" class="btn add"> فیلد جدید</a>
  @endif
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.field_templates.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('reports.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @if(sizeof($field_templates))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th ><a href="{{route('panel.field_templates.index',['search' => $search,'sort' => 'id'    ,'page' => $field_templates->currentPage()])}}">{{__('reports.row')}}</a></th>
          <th ><a href="{{route('panel.field_templates.index',['search' => $search,'sort' => 'title'    ,'page' => $field_templates->currentPage()])}}">{{__('reports.title')}}</a></th>
          <th ><a href="{{route('panel.field_templates.index',['search' => $search,'sort' => 'field_count'    ,'page' => $field_templates->currentPage()])}}">{{__('reports.field_count')}}</a></th>
          <th ><a href="{{route('panel.field_templates.index',['search' => $search,'sort' => 'status'    ,'page' => $field_templates->currentPage()])}}">{{__('reports.status')}}</a></th>
          <th >{{__('reports.operation')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($field_templates as $index => $report_template)
          <tr class="rep-td">
          <td>{{$index+1}}</td>
          <td><a href="{{route('panel.field_templates.show', ['report_template' => $report_template])}}">{{$report_template->title}}</a></td>
          <td>{{$report_template->field_count}}</td>
          <td>{{$report_template->status_str}}</td>
          @if(Auth::user()->isAdmin())
            <td>
              <form action="{{route('panel.field_templates.destroy', ['report_template' => $report_template])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('reports.remove')}}</button>
              </form>
              <a href="{{route('panel.field_templates.edit', ['report_template' => $report_template])}}" class="btn btn-info" role="button">{{__('reports.edit')}}</a>
            </td>
          @else
            @if($experiment_for_bid)
              <td>
                <a class="btn btn-default" href="{{route('panel.experiments.create', ['report_template' => $report_template, 'bid' => $bid])}}">{{__('experiments.create')}}</a>
              </td>
            @else
              <td>
                <a class="btn btn-default" href="{{route('panel.field_templates.show', ['report_template' => $report_template])}}">{{__('experiments.show')}}</a>
              </td>
            @endif
          @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        هیچ فیلدی پیدا نشد.
      </div>
    </div>
  @endif
  @pagination(['links' => $field_templates->links()])
</div>
@endsection
