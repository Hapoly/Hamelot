@extends('layouts.app')
@section('title', $patient->title)
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $patient->first_name }} {{ $patient->last_name }} </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">{{$patient->first_name}}</div>
            <div class="col-md-3">:{{__('patients.first_name')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$patient->last_name}}</div>
            <div class="col-md-3">:{{__('patients.last_name')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$patient->id_number}}</div>
            <div class="col-md-3">:{{__('patients.id_number')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$patient->gender_str()}}</div>
            <div class="col-md-3">:{{__('patients.gender')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$patient->status_str()}}</div>
            <div class="col-md-3">:{{__('patients.status')}}</div>
          </div>
          <div class="row">
            <img src="{{asset($patient->image)}}" />
          </div>
          <div class="row">
            <a href="{{route('manager.patients.edit', ['patient' => $patient])}}" class="btn btn-primary" role="button">{{__('patients.edit')}}</a>
            <form action="{{route('manager.patients.destroy', ['patient' => $patient])}}" method="post">
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
