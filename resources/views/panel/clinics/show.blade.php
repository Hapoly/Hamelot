@extends('layouts.main')
@section('title', $clinic->doctor->full_name)
@section('content')
<?php
  use App\User;
  use App\Department;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $clinic->doctor->full_name }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('clinics.address')}}</td>
            <td>{{$clinic->address}}</td>
          </tr>
          <tr>
            <td>{{__('clinics.phone')}}</td>
            <td>{{$clinic->phone_str}}</td>
          </tr>
          <tr>
            <td>{{__('clinics.mobile')}}</td>
            <td>{{$clinic->mobile_str}}</td>
          </tr>
          <tr>
            <td>{{__('clinics.status')}}</td>
            <td>{{$clinic->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('clinics.public')}}</td>
            <td>{{$clinic->public_str}}</td>
          </tr>
          <tr>
            <td>{{__('clinics.type')}}</td>
            <td>{{$clinic->type_str}}</td>
          </tr>
          <tr>
            <td>{{__('clinics.city_id')}}</td>
            <td>{{$clinic->city->title}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if($clinic->has_permission)
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.clinics.edit', ['clinic' => $clinic])}}" class="btn btn-primary" role="button">{{__('clinics.edit')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.clinics.destroy', ['clinic' => $clinic])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
