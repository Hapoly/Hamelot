@extends('layouts.app')
@section('title', $template->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $template->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$template->title}}</div>
            <div class="col-md-3">:{{__('templates.title')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$template->description}}</div>
            <div class="col-md-3">:{{__('templates.description')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$template->status_str()}}</div>
            <div class="col-md-3">:{{__('templates.status')}}</div>
          </div>
          <div class="row">
            <a href="{{route('admin.templates.edit', ['template' => $template])}}" class="btn btn-primary" role="button">{{__('templates.edit')}}</a>
            <form action="{{route('admin.templates.destroy', ['template' => $template])}}" method="post">
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
