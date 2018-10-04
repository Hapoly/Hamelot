@extends('layouts.main')
@section('title', __('transactions.create_free'))
@section('content')
@php
  use App\Models\Transaction;
@endphp
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <img src="{{$transaction->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('transactions.amount')}}</td>
            <td>{{$transaction->amount_str}}</td>
          </tr>
          @if($transaction->dst_user)
            <tr>
              <td>{{__('transactions.user_id')}}</td>
              <td>{{$transaction->dst_user->full_name}}</td>
            </tr>
          @elseif($transaction->dst_unit)
            <tr>
              <td>{{__('transactions.unit_id')}}</td>
              <td>{{$transaction->dst_unit->complete_title}}</td>
            </tr>
          @endif
          <tr>
            <td>{{__('transactions.type')}}</td>
            <td>{{$transaction->type_str}}</td>
          </tr>
          @if($transaction->type == Transaction::WITHDRAW)
            <tr>
              <td>{{__('transactions.bank_account_id')}}</td>
              <td><a href="{{route('panel.bank-accounts.show', ['bank_account' => $transaction->bank_account])}}">{{$transaction->bank_account->title}}</a></td>
            </tr>
            <tr>
              <td>{{__('bank_accounts.unit_id')}}</td>
              <td><a href="{{route('panel.units.show', ['unit' => $transaction->dst_unit])}}">{{$transaction->dst_unit->complete_title}}</a></td>
            </tr>
          @endif
          <tr>
            <td>{{__('transactions.pay_type')}}</td>
            <td>{{$transaction->pay_type_str}}</td>
          </tr>
          <tr>
            <td>{{__('transactions.status')}}</td>
            <td>{{$transaction->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('transactions.date')}}</td>
            <td>{{$transaction->date_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        @if($transaction->can_modify)
          @if($transaction->type == Transaction::FREE)
            <a href="{{route('panel.transactions.edit.free', ['transaction' => $transaction])}}" class="btn btn-primary" role="button">{{__('transactions.edit')}}</a>
          @elseif($transaction->type == Transaction::WITHDRAW)
            <a href="{{route('panel.transactions.edit.withdraw', ['transaction' => $transaction])}}" class="btn btn-primary" role="button">{{__('transactions.edit')}}</a>
          @endif
        @endif
      </div>
      <div class="col-md-6" style="text-align: center">
        @if($transaction->can_delete)
          <form action="{{route('panel.transactions.destroy', ['transaction' => $transaction])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
