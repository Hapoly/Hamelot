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
                    <option value="1" {{isset($filters)? ($filters['type'] == 1? 'selected': ''): ''}}>{{__('transactions.type_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['type'] == 2? 'selected': ''): ''}}>{{__('transactions.type_str.2')}}</option>
                    <option value="3" {{isset($filters)? ($filters['type'] == 3? 'selected': ''): ''}}>{{__('transactions.type_str.3')}}</option>
                    <option value="4" {{isset($filters)? ($filters['type'] == 4? 'selected': ''): ''}}>{{__('transactions.type_str.4')}}</option>
                    <option value="5" {{isset($filters)? ($filters['type'] == 5? 'selected': ''): ''}}>{{__('transactions.type_str.5')}}</option>
                    <option value="6" {{isset($filters)? ($filters['type'] == 6? 'selected': ''): ''}}>{{__('transactions.type_str.6')}}</option>
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
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $transactions->links()])
</div>
@endsection
