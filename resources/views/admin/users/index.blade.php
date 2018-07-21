@extends('layouts.main')
@section('title', __('users.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('admin.users.create')}}" class="btn btn-info" role="button">{{__('users.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('admin.users.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('users.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('users.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($users))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('admin.users.index',['search' => $search,'sort' => 'id'    ,'page' => $users->currentPage()])}}">{{__('users.row')}}</a></th>
            <th ><a href="{{route('admin.users.index',['search' => $search,'sort' => 'username'    ,'page' => $users->currentPage()])}}">{{__('users.username')}}</a></th>
            <th ><a href="{{route('admin.users.index',['search' => $search,'sort' => 'group_code'    ,'page' => $users->currentPage()])}}">{{__('users.group_code')}}</a></th>
            <th ><a href="{{route('admin.users.index',['search' => $search,'sort' => 'first_name'    ,'page' => $users->currentPage()])}}">{{__('users.first_name')}}</a></th>
            <th ><a href="{{route('admin.users.index',['search' => $search,'sort' => 'last_name'    ,'page' => $users->currentPage()])}}">{{__('users.last_name')}}</a></th>
            <th ><a href="{{route('admin.users.index',['search' => $search,'sort' => 'status'    ,'page' => $users->currentPage()])}}">{{__('users.status')}}</a></th>
            <th >{{__('users.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
            <td>{{$user->id}}</td>
            <td><a href="{{route('admin.users.show', ['user' => $user])}}">{{$user->username}}</a></td>
            <td>{{$user->group_code_str()}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->status_str()}}</td>
            <td>
              <form action="{{route('admin.users.destroy', ['user' => $user])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('users.remove')}}</button>
              </form>
              <a href="{{route('admin.users.edit', ['user' => $user])}}" class="btn btn-info" role="button">{{__('users.edit')}}</a>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('users.no_found')}}
        </div>
      </div>
    @endif
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$users->links()}}
  </div>
@endsection
