@extends('layouts.app')
@section('title', $hospital->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $hospital->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$hospital->title}}</div>
            <div class="col-md-3">:{{__('hospitals.title')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$hospital->address}}</div>
            <div class="col-md-3">:{{__('hospitals.address')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$hospital->phone}}</div>
            <div class="col-md-3">:{{__('hospitals.phone')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$hospital->mobile}}</div>
            <div class="col-md-3">:{{__('hospitals.mobile')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$hospital->status_str()}}</div>
            <div class="col-md-3">:{{__('hospitals.status')}}</div>
          </div>
          <div class="row">
            <img src="{{asset($hospital->image)}}" />
          </div>
          <div class="row">
            <a href="{{route('hospitals.edit', ['hospital' => $hospital])}}" class="btn btn-primary" role="button">{{__('hospitals.edit')}}</a>
            <form action="{{route('hospitals.destroy', ['hospital' => $hospital])}}" method="post">
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
