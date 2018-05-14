@extends('layouts.main')
@section('title', $hospital->title)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $hospital->title }}</h2>
    </div>
    <div class="row">
      <img src="{{asset($hospital->image)}}" class="center">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('hospitals.title')}}</td>
            <td>{{$hospital->title}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.address')}}</td>
            <td>{{$hospital->address}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.phone')}}</td>
            <td>{{$hospital->phone}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.mobile')}}</td>
            <td>{{$hospital->mobile}}</td>
          </tr>
          <tr>
            <td>{{__('hospitals.status')}}</td>
            <td>{{$hospital->status_str()}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('admin.hospitals.edit', ['hospital' => $hospital])}}" class="btn btn-primary" role="button">{{__('hospitals.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('admin.hospitals.destroy', ['hospital' => $hospital])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <h2>{{__('departments.index_title')}}</h2>
    <a href="{{route('admin.departments.create', ['hospital_id' => $hospital->id])}}" class="btn add" style="float:left;margin-left:20px;">{{__('departments.create')}}
      <i class="fa fa-plus"></i>
    </a>
    @if(sizeof($hospital->departments))
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
          @foreach($hospital->departments as $department)
            <tr>
              <td>{{$department->id}}</td>
              <td><a href="{{route('admin.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
              <td>{{$department->status_str()}}</td>
              <td>
                <form action="{{route('admin.departments.destroy', ['department' => $department])}}" style="display: inline" method="POST" class="trash-icon">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">{{__('departments.remove')}}</button>
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
@endsection
