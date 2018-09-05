@extends('layouts.main')
@section('title', __('department_users.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.department_users.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('department_users.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @table([
    'route' => 'panel.department_users.index', 
    'hasAny' => sizeof($department_users) > 0, 
    'not_found' => __('department_users.not_found'),
    'items' => $department_users, 
    'search'  => $search,
    'cols' => [
      'id'            => __('department_users.row'),
      'user_id'       => __('department_users.user_id'),
      'department_id' => __('department_users.department_id'),
      'status'        => __('department_users.status'),
      'NuLL'          => __('department_users.operation'),
    ]])
    @foreach($department_users as $department_user)
      <tr class="hospital-td">
        <td>{{$department_user->id}}</td>
        <td><a href="{{route('panel.users.show', ['user' => $department_user->user])}}">{{$department_user->user->full_name}}</a></td>
        <td><a href="{{route('panel.departments.show', ['department' => $department_user->department])}}">{{$department_user->department->title}}</a></td>
        <td>{{$department_user->status_str}}</td>
        @if(Auth::user()->isAdmin())
                    
        @else
          <td><a class="btn btn-default" href="{{route('panel.department_users.show', ['department_user' => $department_user])}}">{{__('department_users.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $department_users->links()])
</div>
@endsection
