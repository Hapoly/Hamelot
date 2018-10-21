@extends('layouts.main')
@section('title', $bank_account->title)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $bank_account->title }}</h2>
    </div>
    <div class="row">
      <img src="{{$bank_account->image_url}}" class="center" style="width: 25%;">
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('bank_accounts.title')}}</td>
            <td>{{$bank_account->title}}</td>
          </tr>
          <tr>
            <td>{{__('bank_accounts.owner_name')}}</td>
            <td>{{$bank_account->owner_name}}</td>
          </tr>
          <tr>
            <td>{{__('bank_accounts.account_number')}}</td>
            <td>{{$bank_account->account_number}}</td>
          </tr>
          <tr>
            <td>{{__('bank_accounts.card_number')}}</td>
            <td>{{$bank_account->card_number}}</td>
          </tr>
          <tr>
            <td>{{__('bank_accounts.sheba_number')}}</td>
            <td>{{$bank_account->sheba_number}}</td>
          </tr>
          <tr>
            <td>{{__('bank_accounts.bank')}}</td>
            <td>{{$bank_account->bank_title}}</td>
          </tr>
          <tr>
            <td>{{__('bank_accounts.unit_id')}}</td>
            <td>{{$bank_account->unit->complete_title}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.bank-accounts.edit', ['bank_account' => $bank_account])}}" class="btn btn-primary" role="button">{{__('bank_accounts.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.bank-accounts.destroy', ['bank_account' => $bank_account])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
