@extends('layouts.app')
@section('title', __('departments.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('manager.departments.create')}}" class="btn btn-info" role="button">{{__('departments.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('manager.departments.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('departments.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('departments.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($departments))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('manager.departments.index',['search' => $search,'sort' => 'id'    ,'page' => $departments->currentPage()])}}">{{__('departments.row')}}</a></th>
            <th ><a href="{{route('manager.departments.index',['search' => $search,'sort' => 'title'    ,'page' => $departments->currentPage()])}}">{{__('departments.title')}}</a></th>
            <th ><a href="{{route('manager.departments.index',['search' => $search,'sort' => 'hospital_id'    ,'page' => $departments->currentPage()])}}">{{__('departments.hospital_id')}}</a></th>
            <th ><a href="{{route('manager.departments.index',['search' => $search,'sort' => 'status'    ,'page' => $departments->currentPage()])}}">{{__('departments.status')}}</a></th>
            <th >{{__('departments.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($departments as $department)
            <tr>
            <td>{{$department->id}}</td>
            <td><a href="{{route('manager.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
            <td><a href="{{route('manager.hospitals.show', ['hospital' => $department->hospital])}}">{{$department->hospital->title}}</a></td>
            <td>{{$department->status}}</td>
            <td>
              <form action="{{route('manager.departments.destroy', ['department' => $department])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('departments.remove')}}</button>
              </form>
              <a href="{{route('manager.departments.edit', ['department' => $department])}}" class="btn btn-info" role="button">{{__('departments.edit')}}</a>
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
