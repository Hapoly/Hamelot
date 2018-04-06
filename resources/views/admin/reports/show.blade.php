@extends('layouts.app')
@section('title', $report->key->title . ': ' . $report->value)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $report->key->title }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$report->key->title}}</div>
            <div class="col-md-3">:{{__('reports.key_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$report->patient->first_name}} {{$report->patient->last_name}}</div>
            <div class="col-md-3">:{{__('reports.patient_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$report->hospital->title}}</div>
            <div class="col-md-3">:{{__('reports.hospital_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$report->value}}</div>
            <div class="col-md-3">:{{__('reports.value')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$report->date_stamp()}}</div>
            <div class="col-md-3">:{{__('reports.date')}}</div>
          </div>
          <div class="row">
            <a href="{{route('reports.edit', ['report' => $report])}}" class="btn btn-primary" role="button">{{__('reports.edit')}}</a>
            <form action="{{route('reports.destroy', ['report' => $report])}}" method="post">
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
