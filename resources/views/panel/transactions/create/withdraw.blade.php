@extends('layouts.main')
@section('title', __('transactions.create_withdraw'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.transactions.store.withdraw'), 'title' => __('transactions.create_withdraw')])
    @php
      $bank_accounts_rows = [];
      foreach($bank_accounts as $bank_account){
        array_push($bank_accounts_rows, [
          'label' => $bank_account->title . ' ('. $bank_account->unit->complete_title .')',
          'value' => $bank_account->id,
        ]);
      }
    @endphp
    @input_select(['name' => 'bank_account_id', 'value' => old('bank_account_id', ''), 'label' => __('transactions.bank_account_id'), 'required' => true, 'rows' => $bank_accounts_rows, 'row' => true])
    @input_currency(['name' => 'amount', 'value' => old('amount', ''), 'label' => __('transactions.amount'), 'required' => true, 'placeholder' => __('general.tmn'), 'row' => true])
    @input_date_complete(['name' => 'date', 'label' => __('transactions.date'), 'value'  => old('date', time()), 'row' => true])
    @if(Auth::user()->isAdmin())
      @php
        $status_rows = [];
        for($i=1; $i<=3; $i++)
          array_push($status_rows, ['label' => __('transactions.status_str.' . $i), 'value' => $i]);
      @endphp
      @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => __('transactions.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
    @endif
    @submit_row(['value' => 'new', 'label' => __('transactions.save')])
  @endform_create
</div>
@endsection