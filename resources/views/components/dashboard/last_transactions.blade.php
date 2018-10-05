@php
    use App\Models\Transaction;
    $transactions = Transaction::fetch()->orderBy('date', 'desc')->limit(5)->get();
@endphp
<div class="panel panel-default" style="margin-top: 10px">
  <div class="panel-heading">{{__('general.last_transactions')}}</div>
  <div class="panel-body">
    @if(sizeof($transactions) > 0)
        @table([
            'route' => 'panel.transactions.index', 
            'hasAny' => sizeof($transactions) > 0, 
            'not_found' => __('transactions.not_found'),
            'items' => $transactions,
            'search'  => '',
            'cols' => [
                'id'          => __('transactions.row'),
                'amount'      => __('transactions.amount'),
                'date'        => __('transactions.date'),
                'pay_type'    => __('transactions.pay_type'),
                'type'        => __('transactions.type'),
                'status'      => __('transactions.status'),
                'NuLL1'       => __('transactions.description'),
                'NuLL2'       => __('transactions.operation'),
            ]
        ])
            @foreach($transactions as $index => $transaction)
                <tr class="transactions-td">
                <td>{{$index+1}}</td>
                <td>{{$transaction->amount_str}}</td>
                <td>{{$transaction->date_str}}</td>
                <td>{{$transaction->pay_type_str}}</td>
                <td>{{$transaction->type_str}}</td>
                <td>{{$transaction->status_str}}</td>
                <td>{{$transaction->description}}</td>
                <td>
                    @if($transaction->can_modify && $transaction->type == Transaction::FREE)
                        <a class="btn btn-primary" href="{{route('panel.transactions.edit.free', ['transaction' => $transaction])}}">{{__('transactions.edit')}}</a>
                    @endif
                    @if($transaction->can_modify && $transaction->type == Transaction::WITHDRAW)
                        <a class="btn btn-primary" href="{{route('panel.transactions.edit.withdraw', ['transaction' => $transaction])}}">{{__('transactions.edit')}}</a>
                    @endif
                    @if($transaction->can_delete)
                        <a class="btn btn-danger" href="{{route('panel.transactions.destroy', ['transaction' => $transaction])}}">{{__('transactions.destroy')}}</a>
                    @endif
                    <a class="btn btn-default" href="{{route('panel.transactions.show', ['transaction' => $transaction])}}">{{__('transactions.show')}}</a>
                </td>
                </tr>
            @endforeach
        @endtable
    @else
        {{transactions.not_found}}
    @endif
  </div>
</div>