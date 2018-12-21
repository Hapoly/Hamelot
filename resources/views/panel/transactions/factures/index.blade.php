@extends('layouts.main')
@section('title', __('transactions.factures.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  @table([
    'route' => 'panel.transactions.factures.index', 
    'hasAny' => sizeof($units) > 0, 
    'not_found' => __('transactions.not_found'),
    'items' => $units,
    'search'  => '',
    'cols' => [
      'id'          => __('units.row'),
      'title'       => __('units.title'),
      'group_code'  => __('units.group_code'),
      'NuLL1'       => __('units.facture_amount'),
      'NuLL2'       => __('units.operation'),
    ]])
    @foreach($units as $index => $unit)
      <tr class="transactions-td">
        <td>{{$index+1}}</td>
        <td>{{$unit->title}}</td>
        <td>{{$unit->group_str}}</td>
        <td>{{$unit->facture_amount_str}}</td>
        <td>
          <a href="{{route('panel.transactions.factures.live', ['unit' => $unit])}}" class="btn btn-default">{{__('transactions.factures.show')}}</a>
          <a href="{{route('panel.transactions.factures.pay', ['unit' => $unit])}}" class="btn btn-primary">{{__('transactions.factures.pay')}}</a>
        </td>
      </tr>
    @endforeach
  @endtable
</div>
@endsection
