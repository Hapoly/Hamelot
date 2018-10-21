@extends('layouts.main')
@section('title', __('transactions.index_title'))
@section('content')
@php
  use App\Models\Transaction;
@endphp
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
                  <span class="input-group-addon">حداکثر مقدار</span>
                  <input type="number" min="0" class="form-control" value="{{isset($filters)? $filters['max_amount']: ''}}" name="max_amount">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">حداقل مقدار</span>
                  <input type="number" min="0" class="form-control" value="{{isset($filters)? $filters['min_amount']: ''}}" name="min_amount">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                @filter_date_complete(['name' => 'max_date', 'label' => 'تا تاریخ', 'value'  => (isset($filters)? $filters['max_date']: ''), 'required' => true])
              </div>
              <div class="col-md-6">
                @filter_date_complete(['name' => 'min_date', 'label' => 'از تاریخ', 'value'  => (isset($filters)? $filters['min_date']: ''), 'required' => true])
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <select class="form-control" name="status" id="status" style="width: 100%">
                    <option value="0">تمام وضعیت‌ها</option>
                    <option value="1" {{isset($filters)? ($filters['status'] == 1? 'selected': ''): ''}}>{{__('transactions.status_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['status'] == 2? 'selected': ''): ''}}>{{__('transactions.status_str.2')}}</option>
                    <option value="3" {{isset($filters)? ($filters['status'] == 3? 'selected': ''): ''}}>{{__('transactions.status_str.3')}}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select class="form-control" name="type" id="type" style="width: 100%">
                    <option value="0">تمام تراکنش‌ها</option>
                    @for($i=1; $i<8; $i++)
                      <option value="{{$i}}" {{isset($filters)? ($filters['type'] == $i? 'selected': ''): ''}}>{{__('transactions.type_str.' . $i)}}</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select class="form-control" name="pay_type" id="pay_type" style="width: 100%">
                    <option value="0">تمام تراکنش‌ها</option>
                    <option value="1" {{isset($filters)? ($filters['pay_type'] == 1? 'selected': ''): ''}}>{{__('transactions.pay_type_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['pay_type'] == 2? 'selected': ''): ''}}>{{__('transactions.pay_type_str.2')}}</option>
                  </select>
                </div>
              </div>
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
      'amount'      => __('transactions.amount'),
      'date'        => __('transactions.date'),
      'pay_type'    => __('transactions.pay_type'),
      'type'        => __('transactions.type'),
      'status'      => __('transactions.status'),
      'NuLL1'       => __('transactions.description'),
      'NuLL2'       => __('transactions.operation'),
    ]])
    @foreach($transactions as $index => $transaction)
      <tr class="transactions-td">
        <td>{{$index+1}}</td>
        <td>{{$transaction->amount_str}}</td>
        <td>{{$transaction->date_str}}</td>
        <td>{{$transaction->pay_type_str}}</td>
        <td>{{$transaction->type_str}}</td>
        <td>{{$transaction->status_str}}</td>
        <td>{{$transaction->description}}</td>
        <td>
          @if($transaction->can_modify && $transaction->type == Transaction::FREE)
            <a class="btn btn-primary" href="{{route('panel.transactions.edit.free', ['transaction' => $transaction])}}">{{__('transactions.edit')}}</a>
          @endif
          @if($transaction->can_modify && $transaction->type == Transaction::WITHDRAW)
            <a class="btn btn-primary" href="{{route('panel.transactions.edit.withdraw', ['transaction' => $transaction])}}">{{__('transactions.edit')}}</a>
          @endif
          @if($transaction->can_delete)
            <a class="btn btn-danger" href="{{route('panel.transactions.destroy', ['transaction' => $transaction])}}">{{__('transactions.destroy')}}</a>
          @endif
          <a class="btn btn-default" href="{{route('panel.transactions.show', ['transaction' => $transaction])}}">{{__('transactions.show')}}</a>
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $transactions->links()])
</div>
@endsection
