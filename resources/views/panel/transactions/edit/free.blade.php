@extends('layouts.main')
@section('title', __('transactions.edit_free'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.transactions.update.free', ['transaction' => $transaction]), 'title' => __('transactions.edit_free')])
    @php
      $target_type_rows = [
        [
          'label' => __('transactions.target_type_str.' . 1),
          'value' => 1,
        ],
        [
          'label' => __('transactions.target_type_str.' . 2),
          'value' => 2,
        ]
      ];
    @endphp
    @if(old('target_type'))
      @input_select(['name' => 'target_type', 'value' => old('target_type'), 'label' => __('transactions.target_type'), 'required' => true, 'rows' => $target_type_rows])
      @autocomplete(['name' => 'user', 'label' => __('transactions.user_id'), 'value' => old('user', ''), 'required' => false, 'route' => 'patients'])
      @autocomplete(['name' => 'unit', 'label' => __('transactions.unit_id'), 'value' => old('unit', ''), 'required' => false, 'route' => 'units'])
    @else
      @if($transaction->dst_user)
        @input_select(['name' => 'target_type', 'value' => old('target_type', '1'), 'label' => __('transactions.target_type'), 'required' => true, 'rows' => $target_type_rows])
        @autocomplete(['name' => 'user', 'label' => __('transactions.user_id'), 'value' => old('user', $transaction->dst_user->full_name), 'required' => false, 'route' => 'patients'])
        @autocomplete(['name' => 'unit', 'label' => __('transactions.unit_id'), 'value' => old('unit', ''), 'required' => false, 'route' => 'units'])
      @elseif($transaction->dst_unit)
        @input_select(['name' => 'target_type', 'value' => old('target_type', '2'), 'label' => __('transactions.target_type'), 'required' => true, 'rows' => $target_type_rows])
        @autocomplete(['name' => 'user', 'label' => __('transactions.user_id'), 'value' => old('user', ''), 'required' => false, 'route' => 'patients'])
        @autocomplete(['name' => 'unit', 'label' => __('transactions.unit_id'), 'value' => old('unit', $transaction->dst_unit->complete_name), 'required' => false, 'route' => 'units'])
      @endif
    @endif
    @input_currency(['name' => 'amount', 'value' => old('amount', $transaction->amount), 'label' => __('transactions.amount'), 'required' => true, 'placeholder' => __('general.tmn')])
    @input_date_complete(['name' => 'date', 'label' => __('transactions.date'), 'value'  => old('date', time())])
    <script>
      $(document).ready(function(){
        $('#unit').attr('disabled', true);
        $('#user').attr('disabled', false);
        $('#target_type').change(function(){
          let target_type = $('#target_type').val();
          if(target_type == 1){
            $('#unit').attr('disabled', true);
            $('#user').attr('disabled', false);
          }else{
            $('#unit').attr('disabled', false);
            $('#user').attr('disabled', true);
          }
        });
      });
    </script>
    @submit_row(['value' => 'new', 'label' => __('transactions.save')])
  @endform_create
</div>
@endsection