@extends('layouts.app')
@section('title', __('department_users.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('panel.department_users.create')}}" class="btn btn-info" role="button">{{__('department_users.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('panel.department_users.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('department_users.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('department_users.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($department_users))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('panel.department_users.index',['search' => $search,'sort' => 'id'    ,'page' => $department_users->currentPage()])}}">{{__('department_users.row')}}</a></th>
            <th ><a href="{{route('panel.department_users.index',['search' => $search,'sort' => 'department_id'    ,'page' => $department_users->currentPage()])}}">{{__('department_users.department_id')}}</a></th>
            <th ><a href="{{route('panel.department_users.index',['search' => $search,'sort' => 'user_id'    ,'page' => $department_users->currentPage()])}}">{{__('department_users.user_id')}}</a></th>
            <th >{{__('department_users.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($department_users as $department_user)
            <tr>
            <td>{{$department_user->id}}</td>
            <td><a href="{{route('panel.departments.show', ['department' => $department_user->department])}}">{{$department_user->department->title}}</a></td>
            <td><a href="{{route('panel.users.show', ['user' => $department_user->user])}}">{{$department_user->user->first_name}} {{$department_user->user->last_name}}</a></td>
            <td>
              <form action="{{route('panel.department_users.destroy', ['department_user' => $department_user])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('department_users.remove')}}</button>
              </form>
              <a href="{{route('panel.department_users.edit', ['department_user' => $department_user])}}" class="btn btn-info" role="button">{{__('department_users.edit')}}</a>
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
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$department_users->links()}}
  </div>
@endsection
