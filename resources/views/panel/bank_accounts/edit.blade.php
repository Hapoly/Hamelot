@extends('layouts.main')
@section('title', __('bank_accounts.create'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.bank-accounts.update', ['bank_account' => $bank_account]), 'title' => __('bank_accounts.create'), 'row' => true])
    @input_text(['name' => 'title', 'value' => old('title', $bank_account->title), 'label' => __('bank_accounts.title'), 'required' => true, 'row' => true])
    @autocomplete(['name' => 'unit', 'label' => __('bank_accounts.unit_id'), 'value' => old('unit', $bank_account->unit->complete_title), 'required' => false, 'route' => 'units', 'row' => true])
    @input_text(['name' => 'account_number', 'value' => old('account_number', $bank_account->account_number), 'label' => __('bank_accounts.account_number'), 'required' => true, 'row' => true])
    @input_text(['name' => 'owner_name', 'value' => old('owner_name', $bank_account->owner_name), 'label' => __('bank_accounts.owner_name'), 'required' => true, 'row' => true])
    @input_text(['name' => 'card_number', 'value' => old('card_number', $bank_account->card_number), 'label' => __('bank_accounts.card_number'), 'required' => true, 'row' => true])
    @input_text(['name' => 'sheba_number', 'value' => old('sheba_number', $bank_account->sheba_number), 'label' => __('bank_accounts.sheba_number'), 'required' => true, 'row' => true])
    @php
      $bank_rows = [];
      for($i=1; $i<=5; $i++)
        array_push($bank_rows, [
        'label' => __('bank_accounts.banks.' . $i),
        'value' => $i,
      ]);
    @endphp
    @input_select(['name' => 'bank', 'value' => old('bank', $bank_account->bank), 'label' => __('bank_accounts.bank'), 'required' => true, 'rows' => $bank_rows, 'row' => true])
    @submit_row(['value' => 'edit', 'label' => __('bank_accounts.save')])
  @endform_create
</div>
@endsection