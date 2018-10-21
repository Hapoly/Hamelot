@extends('layouts.main')
@section('title', __('transactions.pay_off_index'))
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
              @filter_autocomplete(['name' => 'user_id', 'label' => __('unit_users.user_id'), 'value' => old('user_id', isset($filters)? $filters['user_id']: ''), 'required' => true, 'route' => 'joiners'])
              <div class="col-md-6">
                <div class="from-group">
                  <select class="form-control" name="unit_id" id="unit_id" style="width: 100%">
                    <option value="0">تمام واحد ها</option>
                    @foreach($units as $unit)
                      <option value="{{$unit->id}}" {{isset($filters)? ($filters['unit_id'] == $unit->id? 'selected': '') : ''}}>{{$unit->complete_title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-6" style="text-align: left;">
                <button class="btn btn-info" type="submit">{{__('transactions.search')}}</button>
              </div>
              <div class="col-md-6" style="text-align: right;">
                <a class="btn btn-default" href="{{route('panel.prints.unit_users.index', [$search, 'page' => 0])}}">{{__('unit_users.print_all')}}</a>
                <a class="btn btn-default" href="{{route('panel.prints.unit_users.index', [$search, 'page' => $unit_users->currentPage()])}}">{{__('unit_users.print_this_page')}}</a>
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
      'NuLL1'         => __('units.group_code'),
      'NuLL3'         => __('transactions.dept_amount'),
      'NuLL2'         => __('unit_users.operation'),
    ]])
    @foreach($unit_users as $index => $unit_user)
      <tr>
        <td>{{$index+1}}</td>
        <td><a href="{{route('panel.users.show', ['user' => $unit_user->user])}}">{{$unit_user->user->full_name}}</a></td>
        <td><a href="{{route('panel.units.show', ['hospital' => $unit_user->unit])}}">{{$unit_user->unit->complete_title}}</a></td>
        <td>{{$unit_user->unit->group_str}}</td>
        <td>{{$unit_user->dept_str}}</td>
        <td>
          <a href="{{route('panel.transactions.pay_off.paid', ['unit_user' => $unit_user])}}" class="btn btn-default">{{__('transactions.dept_paid')}}</a>
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $unit_users->links()])
</div>
@endsection
