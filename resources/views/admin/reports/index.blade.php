@extends('layouts.app')
@section('title', __('reports.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('admin.reports.create')}}" class="btn btn-info" role="button">{{__('reports.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('admin.reports.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('reports.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('reports.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($reports))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('admin.reports.index',['search' => $search,'sort' => 'id'    ,'page' => $reports->currentPage()])}}">{{__('reports.row')}}</a></th>
            <th ><a href="{{route('admin.reports.index',['search' => $search,'sort' => 'patient_id'    ,'page' => $reports->currentPage()])}}">{{__('reports.patient_id')}}</a></th>
            <th ><a href="{{route('admin.reports.index',['search' => $search,'sort' => 'hospital_id'    ,'page' => $reports->currentPage()])}}">{{__('reports.hospital_id')}}</a></th>
            <th ><a href="{{route('admin.reports.index',['search' => $search,'sort' => 'value'    ,'page' => $reports->currentPage()])}}">{{__('reports.value')}}</a></th>
            <th ><a href="{{route('admin.reports.index',['search' => $search,'sort' => 'date'     ,'page' => $repoers->currentPage()])}}">{{__('reports.date')}}</a></th>
            <th ><a href="{{route('admin.reports.index',['search' => $search,'sort' => 'status'    ,'page' => $reports->currentPage()])}}">{{__('reports.status')}}</a></th>
            <th >{{__('reports.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reports as $report)
            <tr>
            <td>{{$report->id}}</td>
            <td><a href="{{route('admin.reports.show', ['report' => $report])}}">{{$report->key->title}}</a></td>
            <td>{{$report->value}}</td>
            <td>{{$report->date_str()}}</td>
            <td>{{$report->status_str()}}</td>
            <td>
              <form action="{{route('admin.reports.destroy', ['report' => $report])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('reports.remove')}}</button>
              </form>
              <a href="{{route('admin.reports.edit', ['report' => $report])}}" class="btn btn-info" role="button">{{__('reports.edit')}}</a>
            </td>
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
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$reports->links()}}
  </div>
@endsection
