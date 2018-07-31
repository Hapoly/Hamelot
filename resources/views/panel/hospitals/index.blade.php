@extends('layouts.main')
@section('title', __('hospitals.index.title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
  <a href="{{route('panel.hospitals.create')}}" class="btn add"> بیمارستان جدید</a>
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.hospitals.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('hospitals.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @if(sizeof($hospitals))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th ><a href="{{route('panel.hospitals.index',['search' => $search,'sort' => 'id'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.row')}}</a></th>
          <th ><a href="{{route('panel.hospitals.index',['search' => $search,'sort' => 'title'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.title')}}</a></th>
          <th ><a href="{{route('panel.hospitals.index',['search' => $search,'sort' => 'address'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.address')}}</a></th>
          <th ><a href="{{route('panel.hospitals.index',['search' => $search,'sort' => 'phone'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.phone')}}</a></th>
          <th ><a href="{{route('panel.hospitals.index',['search' => $search,'sort' => 'mobile'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.mobile')}}</a></th>
          <th ><a href="{{route('panel.hospitals.index',['search' => $search,'sort' => 'status'    ,'page' => $hospitals->currentPage()])}}">{{__('hospitals.status')}}</a></th>
          @if(Auth::user()->isAdmin())
            <th >{{__('hospitals.operation')}}</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($hospitals as $hospital)
          <tr>
          <td>{{$hospital->id}}</td>
          <td><a href="{{route('panel.hospitals.show', ['hospital' => $hospital])}}">{{$hospital->title}}</a></td>
          <td>{{$hospital->address}}</td>
          <td>{{$hospital->phone}}</td>
          <td>{{$hospital->mobile}}</td>
          <td>{{$hospital->status_str}}</td>
          @if(Auth::user()->isAdmin())
            <td>
              <form action="{{route('panel.hospitals.destroy', ['hospital' => $hospital])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('hospitals.remove')}}</button>
              </form>
              <a href="{{route('panel.hospitals.edit', ['hospital' => $hospital])}}" class="btn btn-info" role="button">{{__('hospitals.edit')}}</a>
            </td>
          @endif
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
  <div class="container" style="text-align:center;margin-top:30px;">
    {{$hospitals->links()}}
  </div>
</div>
@endsection
