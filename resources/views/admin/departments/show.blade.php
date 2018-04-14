@extends('layouts.app')
@section('title', $department->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $department->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$department->title}}</div>
            <div class="col-md-3">:{{__('departments.title')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$department->description}}</div>
            <div class="col-md-3">:{{__('departments.description')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9"><a href="{{route('admin.hospitals.show', ['hospital' => $department->hospital])}}">{{$department->hospital->title}}</a></div>
            <div class="col-md-3">:{{__('departments.hospital_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$department->status_str()}}</div>
            <div class="col-md-3">:{{__('departments.status')}}</div>
          </div>
          <div class="row">
            <a href="{{route('admin.departments.edit', ['department' => $department])}}" class="btn btn-primary" role="button">{{__('departments.edit')}}</a>
            <form action="{{route('admin.departments.destroy', ['department' => $department])}}" method="post">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger">حذف</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
