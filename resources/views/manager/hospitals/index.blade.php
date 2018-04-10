@extends('layouts.app')
@section('title', __('hospitals.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('hospitals.create')}}" class="btn btn-info" role="button">{{__('hospitals.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('hospitals.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('hospitals.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('hospitals.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($hospitals))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('hospitals.index',['search' => $search,'sort' => 'id'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.row')}}</a></th>
            <th ><a href="{{route('hospitals.index',['search' => $search,'sort' => 'title'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.title')}}</a></th>
            <th ><a href="{{route('hospitals.index',['search' => $search,'sort' => 'address'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.address')}}</a></th>
            <th ><a href="{{route('hospitals.index',['search' => $search,'sort' => 'phone'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.phone')}}</a></th>
            <th ><a href="{{route('hospitals.index',['search' => $search,'sort' => 'mobile'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.mobile')}}</a></th>
            <th ><a href="{{route('hospitals.index',['search' => $search,'sort' => 'status'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.status')}}</a></th>
            <th >{{__('hospitals.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($hospitals as $hospital)
            <tr>
            <td>{{$hospital->id}}</td>
            <td><a href="{{route('hospitals.show', ['hospital' => $hospital])}}">{{$hospital->title}}</a></td>
            <td>{{$hospital->address}}</td>
            <td>{{$hospital->phone}}</td>
            <td>{{$hospital->mobile}}</td>
            <td>{{$hospital->status}}</td>
            <td>
              <form action="{{route('hospitals.destroy', ['hospital' => $hospital])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('hospitals.remove')}}</button>
              </form>
              <a href="{{route('hospitals.edit', ['hospital' => $hospital])}}" class="btn btn-info" role="button">{{__('hospitals.edit')}}</a>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('hospitals.not_found')}}
        </div>
      </div>
    @endif
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$hospitals->links()}}
  </div>
@endsection
