@extends('layouts.app')
@section('title', __('keys.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('panel.keys.create')}}" class="btn btn-info" role="button">{{__('keys.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('panel.keys.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('keys.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('keys.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($keys))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('panel.keys.index',['search' => $search,'sort' => 'id'    ,'page' => $keys->currentPage()])}}">{{__('keys.row')}}</a></th>
            <th ><a href="{{route('panel.keys.index',['search' => $search,'sort' => 'title'    ,'page' => $keys->currentPage()])}}">{{__('keys.title')}}</a></th>
            <th ><a href="{{route('panel.keys.index',['search' => $search,'sort' => 'description'    ,'page' => $keys->currentPage()])}}">{{__('keys.description')}}</a></th>
            <th ><a href="{{route('panel.keys.index',['search' => $search,'sort' => 'status'    ,'page' => $keys->currentPage()])}}">{{__('keys.status')}}</a></th>
            <th >{{__('keys.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($keys as $key)
            <tr>
            <td>{{$key->id}}</td>
            <td><a href="{{route('panel.keys.show', ['key' => $key])}}">{{$key->title}}</a></td>
            <td>{{$key->description}}</td>
            <td><a href="{{route('panel.templates.show', ['template' => $key->template])}}">{{$key->template->title}}</a></td>
            <td>{{$key->type_str()}}<td>
            <td>{{$key->status_str()}}</td>
            <td>
              <form action="{{route('panel.keys.destroy', ['key' => $key])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('keys.remove')}}</button>
              </form>
              <a href="{{route('panel.keys.edit', ['key' => $key])}}" class="btn btn-info" role="button">{{__('keys.edit')}}</a>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('keys.not_found')}}
        </div>
      </div>
    @endif
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$keys->links()}}
  </div>
@endsection
