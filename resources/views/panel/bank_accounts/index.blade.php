@extends('layouts.main')
@section('title', __('bank_accounts.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  @table([
    'route' => 'panel.bank_accounts.index', 
    'hasAny' => sizeof($bank_accounts) > 0, 
    'not_found' => __('bank_accounts.not_found'),
    'items' => $bank_accounts,
    'search'  => $search,
    'cols' => [
      'id'          => __('bank_accounts.row'),
      'title'       => __('bank_accounts.title'),
      'user_id'     => __('bank_accounts.unit_id'),
      'city_id'     => __('bank_accounts.bank'),
      'NuLL'        => __('bank_accounts.operation'),
    ]])
    @foreach($bank_accounts as $index => $bank_account)
      <tr class="bank_account-td">
        <td>{{$index+1}}</td>
        <td>{{$bank_account->title}}</td>
        <td>{{$bank_account->unit->complete_title}}</td>
        <td>{{$bank_account->bank_title}}</td>
        <td>
          @operation_th(['base' => 'panel.bank-accounts', 'label' => 'bank_account', 'item' => $bank_account, 'remove_label' => __('bank_accounts.remove'), 'edit_label' => __('bank_accounts.edit'), 'show_label' => __('bank_accounts.show')])
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $bank_accounts->links()])
</div>
@endsection
