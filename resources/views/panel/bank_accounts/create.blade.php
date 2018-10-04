@extends('layouts.main')
@section('title', __('bank_accounts.create'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.bank-accounts.store'), 'title' => __('bank_accounts.create')])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => __('bank_accounts.title'), 'required' => true])
    @autocomplete(['name' => 'unit', 'label' => __('bank_accounts.unit_id'), 'value' => old('unit', ''), 'required' => false, 'route' => 'units'])
    @input_text(['name' => 'account_number', 'value' => old('account_number', ''), 'label' => __('bank_accounts.account_number'), 'required' => true])
    @input_text(['name' => 'owner_name', 'value' => old('owner_name', ''), 'label' => __('bank_accounts.owner_name'), 'required' => true])
    @input_text(['name' => 'card_number', 'value' => old('card_number', ''), 'label' => __('bank_accounts.card_number'), 'required' => true])
    @input_text(['name' => 'sheba_number', 'value' => old('sheba_number', ''), 'label' => __('bank_accounts.sheba_number'), 'required' => true])
    @php
      $bank_rows = [];
      for($i=1; $i<=5; $i++)
        array_push($bank_rows, [
        'label' => __('bank_accounts.banks.' . $i),
        'value' => $i,
      ]);
    @endphp
    @input_select(['name' => 'bank', 'value' => old('bank', ''), 'label' => __('bank_accounts.bank'), 'required' => true, 'rows' => $bank_rows])
    @submit_row(['value' => 'new', 'label' => __('bank_accounts.save')])
  @endform_create
</div>
@endsection