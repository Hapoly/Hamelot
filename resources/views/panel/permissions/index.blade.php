@extends('layouts.main')
@section('title', __('permissions.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
    @if(!Auth::user()->isPatient() && !Auth::user()->isManager() && !Auth::user()->isAdmin())
      <a href="{{route('panel.permissions.create')}}" class="btn add"> دسترسی جدید</a>
    @endif
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.permissions.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('permissions.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  <?php
    $cols = [
      'id'            => __('permissions.row'),
    ];
    if(Auth::user()->isAdmin()){
      $cols['requester_id'] = __('permissions.requester_id');
      $cols['patient_id'] = __('permissions.patient_id');
    }else if(Auth::user()->isPatient()){
      $cols['requester_id'] = __('permissions.requester_id');
    }else{
      $cols['patient_id'] = __('permissions.patient_id');
    }
    $cols['date']   = __('permissions.date');
    $cols['status'] = __('permissions.status');
    $cols['NuLL']   = __('permissions.operation');
  ?>
  @table([
    'route' => 'panel.permissions.index', 
    'hasAny' => sizeof($permissions) > 0, 
    'not_found' => __('permissions.not_found'),
    'items' => $permissions, 
    'search'  => $search,
    'cols' => $cols
    ])
    @foreach($permissions as $permission)
      <tr>
        <td>{{$permission->id}}</td>
        @if(!Auth::user()->isPatient())
          <td>{{$permission->patient->full_name}}</td>
        @endif
        @if(Auth::user()->isAdmin() || Auth::user()->isPatient())
          <td>{{$permission->requester->full_name}}</td>
        @endif
        <td>{{$permission->status_str}}</td>
        <td>{{$permission->date_str}}</td>
        <td>
          <form action="{{route('panel.permissions.inline_update', ['permission' => $permission])}}" method="post">
            @csrf
            <div class="col-md-12" style="text-align: center">
              @if(Auth::user()->isAdmin() || Auth::user()->id == $permission->patient_id)
                @if($permission->pending())
                  <button type="submit" name="action" value="accept" class="btn btn-primary">{{__('permissions.accept')}}</button>
                  <button type="submit" name="action" value="refuse" class="btn btn-danger">{{__('permissions.refuse')}}</button>
                @elseif($permission->accepted())
                  <button type="submit" name="action" value="cancel" class="btn btn-warning">{{__('permissions.cancel')}}</button>
                @endif
              @endif
              @if(Auth::user()->isAdmin() || Auth::user()->id == $permission->requester_id)
                @if(!$permission->canceled())
                  <button type="submit" name="action" value="cancel" class="btn btn-warning">{{__('permissions.cancel')}}</button>
                @endif
              @endif
              <a class="btn btn-info" href="{{route('panel.permissions.show', ['permission' => $permission])}}">{{__('permissions.show')}}</a>
            </div>
          </form>
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $permissions->links()])
</div>
@endsection
