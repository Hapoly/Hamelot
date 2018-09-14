@extends('layouts.main')
@section('title', __('unit_users.index_title'))
@section('content')
<?php
  use App\Models\UnitUser;
?>
<div class="filter-panel">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-heading">جستجو</div>
        <div class="panel-body">
          <form>
            <div class="row">
              @filter_autocomplete(['name' => 'user_id', 'label' => __('unit_users.user_id'), 'value' => old('user_id', isset($filters)? $filters['full_name']: ''), 'required' => true, 'route' => 'members'])
              <div class="col-md-6">
                <div class="from-group">
                  <select class="form-control" name="unit_id" id="unit_id" style="width: 100%">
                    <option value="0">تمام واحد ها</option>
                    @foreach($units as $unit)
                      <option value="{{$unit->id}}">{{$unit->complete_title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="status" id="status" style="width: 100%">
                    <option value="0">تمام وضعیت‌ها</option>
                    <option value="1" {{isset($filters)? ($filters['status'] == 1? 'selected': '') : ''}}>{{__('unit_users.status_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['status'] == 2? 'selected': '') : ''}}>{{__('unit_users.status_str.2')}}</option>
                    <option value="3" {{isset($filters)? ($filters['status'] == 3? 'selected': '') : ''}}>{{__('unit_users.status_str.3')}}</option>
                    <option value="4" {{isset($filters)? ($filters['status'] == 4? 'selected': '') : ''}}>{{__('unit_users.status_str.4')}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;text-align: left;">
              <div class="col-md-6">
                <button class="btn btn-info" type="submit">{{__('unit_users.search')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-bottom:50px;">
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
        <td><a href="{{route('panel.units.show', ['hospital' => $unit_user->unit])}}">{{$unit_user->unit->title}}</a></td>
        <td>{{$unit_user->status_str}}</td>
        <td>
          @if($unit_user->has_manager_permission)
              @if($unit_user->accepted())
                <a class="btn btn-default" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user, 'action' => 'cancel'])}}">{{__('unit_users.cancel')}}</a></td>
              @elseif($unit_user->pending())
                <a class="btn btn-primary" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user, 'action' => 'accept'])}}">{{__('unit_users.accept')}}</a>
                <a class="btn btn-danger" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user, 'action' => 'refuse'])}}">{{__('unit_users.refuse')}}</a>
              @else
                -
              @endif
            </form>
          @else
            <a class="btn btn-default" href="{{route('panel.unit_users.show', ['unit_user' => $unit_user])}}">{{__('unit_users.show')}}</a><
          @endif
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $unit_users->links()])
</div>
@endsection
