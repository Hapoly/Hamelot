@extends('layouts.app')
@section('title', __('templates.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('admin.templates.create')}}" class="btn btn-info" role="button">{{__('templates.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('admin.templates.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('templates.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('templates.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($templates))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('admin.templates.index',['search' => $search,'sort' => 'id'    ,'page' => $templates->currentPage()])}}">{{__('templates.row')}}</a></th>
            <th ><a href="{{route('admin.templates.index',['search' => $search,'sort' => 'title'    ,'page' => $templates->currentPage()])}}">{{__('templates.title')}}</a></th>
            <th ><a href="{{route('admin.templates.index',['search' => $search,'sort' => 'description'    ,'page' => $templates->currentPage()])}}">{{__('templates.description')}}</a></th>
            <th ><a href="{{route('admin.templates.index',['search' => $search,'sort' => 'status'    ,'page' => $templates->currentPage()])}}">{{__('templates.status')}}</a></th>
            <th >{{__('templates.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($templates as $template)
            <tr>
            <td>{{$template->id}}</td>
            <td><a href="{{route('admin.templates.show', ['template' => $template])}}">{{$template->title}}</a></td>
            <td>{{$template->description}}</td>
            <td>{{$template->status}}</td>
            <td>
              <form action="{{route('admin.templates.destroy', ['template' => $template])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('templates.remove')}}</button>
              </form>
              <a href="{{route('admin.templates.edit', ['template' => $template])}}" class="btn btn-info" role="button">{{__('templates.edit')}}</a>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('templates.not_found')}}
        </div>
      </div>
    @endif
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$templates->links()}}
  </div>
@endsection
