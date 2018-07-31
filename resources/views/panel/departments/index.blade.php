@extends('layouts.main')
@section('title', __('departments.index.title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
    <a href="{{route('panel.departments.create')}}" class="btn add"> {{__('departments.create')}}</a>
  </div>
  <div class="col-md-8 col-sm-9">
    <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.departments.index',['sort' => $sort])}}" method="get">
      <div class="input-group add-on">
        <div class="input-group-btn">
          <button class="btn" type="submit">
          {{__('departments.search')}}
          <!-- <i class="glyphicon glyphicon-search"></i> -->
          </button>
        </div>
        <input class="form-control search-box" placeholder="{{__('departments.index_title')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
      </div>
    </form>
  </div>
  </div>
    @if(sizeof($departments))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th ><a href="{{route('panel.departments.index',['search' => $search,'sort' => 'id'    ,'page' => $departments->currentPage()])}}">{{__('departments.row')}}</a></th>
          <th ><a href="{{route('panel.departments.index',['search' => $search,'sort' => 'title'    ,'page' => $departments->currentPage()])}}">{{__('departments.title')}}</a></th>
          <th ><a href="{{route('panel.departments.index',['search' => $search,'sort' => 'hospital_id'    ,'page' => $departments->currentPage()])}}">{{__('departments.hospital_id')}}</a></th>
          <th ><a href="{{route('panel.departments.index',['search' => $search,'sort' => 'status'    ,'page' => $departments->currentPage()])}}">{{__('departments.status')}}</a></th>
          <th >{{__('departments.operation')}}</th>
        </tr>
      </thead>
      <tbody>
          @foreach($departments as $department)
            <tr>
            <td>{{$department->id}}</td>
            <td><a href="{{route('panel.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
            <td><a href="{{route('panel.hospitals.show', ['hospital' => $department->hospital])}}">{{$department->hospital->title}}</a></td>
            <td>{{$department->status_str}}</td>
            <td>
              <form action="{{route('panel.departments.destroy', ['department' => $department])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('departments.remove')}}</button>
              </form>
              <a href="{{route('panel.departments.edit', ['department' => $department])}}" class="btn btn-info" role="button">{{__('departments.edit')}}</a>
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
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$departments->links()}}
  </div>
@endsection
