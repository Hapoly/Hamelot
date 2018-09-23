@extends('layouts.main')
@section('title', $address->title)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $address->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$address->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('addresses.title')}}</td>
            <td>{{$address->title}}</td>
          </tr>
          <tr>
            <td>{{__('addresses.plain')}}</td>
            <td>{{$address->plain}}</td>
          </tr>
          <tr>
            <td>{{__('addresses.city_id')}}</td>
            <td>{{$address->city->title}} ({{$address->city->province->title}})</td>
          </tr>
          @if(!(Auth::user()->isAdmin())))
            <tr>
              <td>{{__('addresses.user_id')}}</td>
              <td>{{$address->user->full_name}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.addresses.edit', ['address' => $address])}}" class="btn btn-primary" role="button">{{__('addresses.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.addresses.destroy', ['address' => $address])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
