@extends('layouts.main')
@section('title', __('transactions.edit_withdraw'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.transactions.update.withdraw', ['transaction' => $transaction]), 'title' => __('transactions.edit_withdraw')])
  @php
      $bank_accounts_rows = [];
      foreach($bank_accounts as $bank_account){
        array_push($bank_accounts_rows, [
          'label' => $bank_account->title . ' ('. $bank_account->unit->complete_title .')',
          'value' => $bank_account->id,
        ]);
      }
    @endphp
    @input_select(['name' => 'bank_account_id', 'value' => old('bank_account_id', $transaction->target), 'label' => __('transactions.bank_account_id'), 'required' => true, 'rows' => $bank_accounts_rows])
    @input_currency(['name' => 'amount', 'value' => old('amount', $transaction->amount), 'label' => __('transactions.amount'), 'required' => true, 'placeholder' => __('general.tmn')])
    @input_date_complete(['name' => 'date', 'label' => __('transactions.date'), 'value'  => old('date', $transaction->date)])
    @if(Auth::user()->isAdmin())
      @php
        $status_rows = [];
        for($i=1; $i<=3; $i++)
          array_push($status_rows, ['label' => __('transactions.status_str.' . $i), 'value' => $i]);
      @endphp
      @input_select(['name' => 'status', 'value' => old('status', $transaction->status), 'label' => __('transactions.status'), 'required' => true, 'rows' => $status_rows])  
    @endif
    @submit_row(['value' => 'edit', 'label' => __('transactions.save')])
  @endform_create
</div>
@endsection