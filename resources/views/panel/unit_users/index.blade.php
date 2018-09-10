@extends('layouts.main')
@section('title', __('unit_users.index_title'))
@section('content')
<?php
  use App\Models\UnitUser;
?>
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
      'unit_id'       => __('unit_users.unit_id'),
      'status'        => __('unit_users.status'),
      'NuLL'          => __('unit_users.operation'),
    ]])
    @foreach($unit_users as $unit_user)
      <tr>
        <td>{{$unit_user->id}}</td>
        <td><a href="{{route('panel.users.show', ['user' => $unit_user->user])}}">{{$unit_user->user->full_name}}</a></td>
        @switch($unit_user->type)
          @case(UnitUser::HOSPITAL)
            <td><a href="{{route('panel.hospitals.show', ['hospital' => $unit_user->unit])}}">{{$unit_user->unit->title}}</a></td>
            @break
          @case(UnitUser::DEPARTMENT)
            <td><a href="{{route('panel.departments.show', ['hospital' => $unit_user->unit])}}">{{$unit_user->unit->title}}</a></td>
            @break
          @case(UnitUser::POLICLINIC)
            <td><a href="{{route('panel.policlinics.show', ['hospital' => $unit_user->unit])}}">{{$unit_user->unit->title}}</a></td>
            @break
        @endswitch
        <td>{{$unit_user->status_str}}</td>
        @if($unit_user->has_manager_permission)
          <form method="POST" action="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user])}}">
            @csrf
            @if($unit_user->accepted())
              <td><button class="btn btn-default" type="submit" name="action" value="cancel">{{__('unit_users.cancel')}}</button></td>
            @elseif($unit_user->pending())
              <td>
                <button class="btn btn-primary" type="submit" name="action" value="accept">{{__('unit_users.accept')}}</button>
                <button class="btn btn-danger" type="submit" name="action" value="refuse">{{__('unit_users.refuse')}}</button>
              </td>
            @else
              <td> - </td>
            @endif
          </form>
        @else
          <td><a class="btn btn-default" href="{{route('panel.unit_users.show', ['unit_user' => $unit_user])}}">{{__('unit_users.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $unit_users->links()])
</div>
@endsection
