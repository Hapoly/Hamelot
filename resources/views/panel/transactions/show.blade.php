@extends('layouts.main')
@section('title', __('transactions.create_free'))
@section('content')
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
        <a href="{{route('panel.transactions.edit.free', ['transaction' => $transaction])}}" class="btn btn-primary" role="button">{{__('transactions.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.transactions.destroy', ['transaction' => $transaction])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
