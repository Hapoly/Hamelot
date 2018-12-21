@extends('layouts.main')
@section('title', __('transactions.factures.index_title'))
@section('content')
<div class="filter-panel">
  <div class="row justify-content-center">
    <div class="panel panel-default">
      <div class="panel-heading">صورتحساب {{$unit->title}}</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6">
              میزان بدهی: {{$unit->facture_amount_str}}
            </div>
            <div class="col-md-6">
              تعداد تراکنش ها: {{sizeof($transactions)}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <a class="btn btn-primary" href="{{route('panel.transactions.factures.pay', ['unit' => $unit])}}">پرداخت</a>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="row" style="margin-bottom:50px;">
  @table([
    'route' => 'panel.transactions.factures.index', 
    'hasAny' => sizeof($transactions) > 0, 
    'not_found' => __('transactions.not_found'),
    'items' => $transactions,
    'search'  => '',
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
        <td>{{$transaction->comission_str}}</td>
        <td>{{$transaction->date_str}}</td>
        <td>{{$transaction->pay_type_str}}</td>
        <td>{{$transaction->type_str}}</td>
        <td>{{$transaction->status_str}}</td>
        <td>{{$transaction->description}}</td>
      </tr>
    @endforeach
  @endtable
</div>
@endsection
