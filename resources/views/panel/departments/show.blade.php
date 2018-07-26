@extends('layouts.main')
@section('title', $department->title)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $department->title }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('departments.title')}}</td>
            <td>{{$department->title}}</td>
          </tr>
          <tr>
            <td>{{__('departments.description')}}</td>
            <td>{{$department->description}}</td>
          </tr>
          <tr>
            <td>{{__('departments.hospital_id')}}</td>
            <td><a href="{{route('panel.hospitals.show', ['hospital' => $department->hospital])}}">{{$department->hospital->title}}</a></td>
          </tr>
          <tr>
            <td>{{__('departments.status')}}</td>
            <td>{{$department->status_str()}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.departments.edit', ['department' => $department])}}" class="btn btn-primary" role="button">{{__('departments.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.departments.destroy', ['department' => $department])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
