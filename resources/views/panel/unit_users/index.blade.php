@extends('layouts.main')
@section('title', __('unit_users.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.unit_users.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('unit_users.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @table([
    'route' => 'panel.unit_users.index', 
    'hasAny' => sizeof($unit_users) > 0, 
    'not_found' => __('unit_users.not_found'),
    'items' => $unit_users, 
    'search'  => $search,
    'cols' => [
      'id'            => __('unit_users.row'),
      'user_id'       => __('unit_users.user_id'),
      'department_id' => __('unit_users.department_id'),
      'status'        => __('unit_users.status'),
      'NuLL'          => __('unit_users.operation'),
    ]])
    @foreach($unit_users as $unit_user)
      <tr class="hospital-td">
        <td>{{$unit_user->id}}</td>
        <td><a href="{{route('panel.users.show', ['user' => $unit_user->user])}}">{{$unit_user->user->full_name}}</a></td>
        <td><a href="{{route('panel.departments.show', ['department' => $unit_user->department])}}">{{$unit_user->department->title}}</a></td>
        <td>{{$unit_user->status_str}}</td>
        @if(Auth::user()->isAdmin())
                    
        @else
          <td><a class="btn btn-default" href="{{route('panel.unit_users.show', ['unit_user' => $unit_user])}}">{{__('unit_users.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $unit_users->links()])
</div>
@endsection
