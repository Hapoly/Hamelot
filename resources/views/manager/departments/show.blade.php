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
            <div class="col-md-9"><a href="{{route('manager.hospitals.show', ['hospital' => $department->hospital])}}">{{$department->hospital->title}}</a></div>
            <div class="col-md-3">:{{__('departments.hospital_id')}}</div>
          </div>
          <div class="row">
            <div class="col-md-9">{{$department->status_str()}}</div>
            <div class="col-md-3">:{{__('departments.status')}}</div>
          </div>
          <div class="row">
            <a href="{{route('manager.departments.edit', ['department' => $department])}}" class="btn btn-primary" role="button">{{__('departments.edit')}}</a>
            <form action="{{route('manager.departments.destroy', ['department' => $department])}}" method="post">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger">حذف</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8" style="margin-top: 1rem">
      <a href="{{route('manager.patients.create',['department' => $department])}}" class="btn btn-info" role="button">{{__('patients.create')}}</a>
    </div>
    <div class="col-md-8" style="margin-top: 1rem">
      <div class="card">
        <div class="card-header">{{__('patients.index_title')}}</div>
        <div class="card-body">
          @if(sizeof($department->patients))
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>{{__('patients.row')}}</th>
                  <th>{{__('patients.first_name')}}</th>
                  <th>{{__('patients.last_name')}}</th>
                  <th>{{__('patients.status')}}</th>
                  <th>{{__('patients.operation')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($department->patients as $patient)
                  <tr>
                    <td>{{$patient->id}}</td>
                    <td><a href="{{route('manager.patients.show', ['patient' => $patient])}}">{{$patient->title}}</a></td>
                    <td>{{$patient->status_str()}}</td>
                    <td>
                      <a href="{{route('manager.patients.edit', ['patient' => $patient])}}" class="btn btn-info" role="button">{{__('patients.edit')}}</a>
                      <form action="{{route('manager.patients.destroy', ['patient' => $patient])}}" style="display: inline" method="POST" class="trash-icon">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">{{__('patients.remove')}}</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <div class="row">
              <div class="col-md-12" style="text-align: center">
                {{__('patients.not_found')}}
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
