@extends('layouts.main')
@section('title', __('transactions.index_title'))
@section('content')
<div class="filter-panel">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-heading">جستجو</div>
        <div class="panel-body">
          <form>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">آدرس</span>
                  <input type="text" class="form-control" value="{{isset($filters)? $filters['plain']: ''}}" name="plain" placeholder="خیابان شهربازی">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">عنوان</span>
                  <input type="text" class="form-control" value="{{isset($filters)? $filters['title']: ''}}" name="title" placeholder="خانه مادر">
                </div>
              </div>
            </div>
            <div class="row">
              @filter_city(['province_id' => isset($filters)? $filters['province_id']: 0, 'city_id' => isset($filters)? $filters['city_id']: 0])
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-12">
                <button class="btn btn-info" type="submit">{{__('transactions.search')}}</button>
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
    'route' => 'panel.transactions.index', 
    'hasAny' => sizeof($transactions) > 0, 
    'not_found' => __('transactions.not_found'),
    'items' => $transactions,
    'search'  => $search,
    'cols' => [
      'id'          => __('transactions.row'),
      'title'       => __('transactions.title'),
      'user_id'     => __('transactions.user_id'),
      'city_id'     => __('transactions.city_id'),
      'NuLL'        => __('transactions.operation'),
    ]])
    @foreach($transactions as $address)
      <tr class="address-td {{$address->joined? 'tr-highlight': ''}}">
        <td>{{$address->id}}</td>
        <td><a href="{{route('panel.transactions.show', ['address' => $address])}}">{{$address->title}}</a></td>
        <td>{{$address->user->full_name}}</td>
        <td>{{$address->city->title}} ({{$address->city->province->title}})</td>
        @if($address->has_permission_to_write)
          <td>
            @operation_th(['base' => 'panel.transactions', 'label' => 'address', 'item' => $address, 'remove_label' => __('transactions.remove'), 'edit_label' => __('transactions.edit'), 'show_label' => __('transactions.show')])
          </td>
        @else
          <td><a class="btn btn-default" href="{{route('panel.transactions.show', ['$address' => $address])}}">{{__('transactions.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $transactions->links()])
</div>
@endsection
