@extends('layouts.main')
@section('title', __('permissions.index_title'))
@section('content')
<div class="filter-panel">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-heading">جستجو</div>
        <div class="panel-body">
          <form>
            <div class="row">
              @filter_autocomplete(['name' => 'requester_id', 'label' => __('permissions.requester_id'), 'value' => old('requester_id', isset($filters)? $filters['requester_name']: ''), 'required' => true, 'route' => 'members'])
              @filter_autocomplete(['name' => 'patient_id', 'label' => __('permissions.patient_id'), 'value' => old('patient_id', isset($filters)? $filters['patient_name']: ''), 'required' => true, 'route' => 'patients'])
            </div>
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="status" id="status" style="width: 100%">
                    <option value="0">تمام وضعیت‌ها</option>
                    <option value="1" {{isset($filters)? ($filters['status'] == 1? 'selected': '') : ''}}>{{__('permissions.status_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['status'] == 2? 'selected': '') : ''}}>{{__('permissions.status_str.2')}}</option>
                    <option value="3" {{isset($filters)? ($filters['status'] == 3? 'selected': '') : ''}}>{{__('permissions.status_str.3')}}</option>
                    <option value="4" {{isset($filters)? ($filters['status'] == 4? 'selected': '') : ''}}>{{__('permissions.status_str.4')}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;text-align: left;">
              <div class="col-md-6">
                <button class="btn btn-info" type="submit">{{__('permissions.search')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-bottom:50px;">
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
    'not_found' => __('permissions.index_not_found'),
    'items' => $permissions, 
    'search'  => $search,
    'cols' => $cols
    ])
    @foreach($permissions as $permission)
      <tr>
        <td>{{$permission->id}}</td>
        @if(Auth::user()->isAdmin() || Auth::user()->isPatient())
          <td>{{$permission->requester->full_name}}</td>
        @endif
        @if(!Auth::user()->isPatient())
          <td>{{$permission->patient->full_name}}</td>
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
              @if(Auth::user()->id == $permission->requester_id)
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
