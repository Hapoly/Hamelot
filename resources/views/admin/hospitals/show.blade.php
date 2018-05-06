@extends('layouts.main')
@section('title', $hospital->title)
@section('content')
<div class="container">
  <div class="card">
    <div class="page-header">
      <h2>{{ $hospital->title }}</h2>      
    </div>
    <form class="myform" >
      <img src="{{asset($hospital->image)}}" class="center">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-2">
            <label class="first" for="email">{{__('hospitals.title')}}:</label>
          </div>
          <div class="col-sm-10">
            <p class="first">{{$hospital->title}}</p>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-2">
            <label class="other" for="email">{{__('hospitals.address')}}:</label>
            </div>
              <div class="col-sm-10">
                <p class="other">{{$hospital->address}}</p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-2">
                <label class="other" for="email">{{__('hospitals.phone')}}:</label>
              </div>
              <div class="col-sm-10">
                <p class="other">{{$hospital->phone}}</p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-2">
                <label class="other" for="email">{{__('hospitals.mobile')}}:</label>
              </div>
              <div class="col-sm-10">
                <p class="other">{{$hospital->mobile}}</p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-2">
                <label class="other" for="email">{{__('hospitals.status')}}:</label>
              </div>
              <div class="col-sm-10">
                <p class="other">{{$hospital->status}}</p>
              </div>
            </div>
          </div>
          <a href="{{route('admin.hospitals.edit', ['hospital' => $hospital])}}" class="btn btn-primary" role="button">{{__('hospitals.edit')}}</a>
          <form action="{{route('admin.hospitals.destroy', ['hospital' => $hospital])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>  
    </form>
  </div>
  <div class="card">
    <div class="">
      <h2>{{__('departments.index_title')}}</h2>      
    </div>
    <a href="{{route('admin.departments.create')}}" class="btn add" style="float:left;margin-left:20px;">{{__('departments.create')}}
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
