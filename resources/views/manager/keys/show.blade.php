@extends('layouts.app')
@section('title', $key->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $key->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$key->title}}</div>
            <div class="col-md-3">:{{__('keys.title')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$key->description}}</div>
            <div class="col-md-3">:{{__('keys.description')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$key->template->title}}</div>
            <div class="col-md-3">:{{__('keys.template_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$key->type_str()}}</div>
            <div class="col-md-3">:{{__('keys.type')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$key->status_str()}}</div>
            <div class="col-md-3">:{{__('keys.status')}}</div>
          </div>
          <div class="row">
            <a href="{{route('keys.edit', ['key' => $key])}}" class="btn btn-primary" role="button">{{__('keys.edit')}}</a>
            <form action="{{route('keys.destroy', ['key' => $key])}}" method="post">
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
