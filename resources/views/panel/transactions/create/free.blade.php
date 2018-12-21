@extends('layouts.main')
@section('title', __('transactions.create_free'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.transactions.store.free'), 'title' => __('transactions.create_free')])
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
    @input_select(['name' => 'target_type', 'value' => old('target_type', ''), 'label' => __('transactions.target_type'), 'required' => true, 'rows' => $target_type_rows, 'row' => true])
    @autocomplete(['name' => 'user', 'label' => __('transactions.user_id'), 'value' => old('user', ''), 'required' => false, 'route' => 'patients', 'row' => true])
    @autocomplete(['name' => 'unit', 'label' => __('transactions.unit_id'), 'value' => old('unit', ''), 'required' => false, 'route' => 'units', 'row' => true])
    @input_currency(['name' => 'amount', 'value' => old('amount', ''), 'label' => __('transactions.amount'), 'required' => true, 'placeholder' => __('general.tmn'), 'row' => true])
    @input_date_complete(['name' => 'date', 'label' => __('transactions.date'), 'value'  => old('date', time()), 'row' => true])
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