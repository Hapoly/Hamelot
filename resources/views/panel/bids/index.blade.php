@extends('layouts.main')
@section('title', __('bids.index_title'))
@section('content')
@php
  use App\Models\Bid;
@endphp
<div class="row" style="margin-bottom:50px;">
  @table([
    'route' => 'panel.bids.index', 
    'hasAny' => sizeof($bids) > 0, 
    'not_found' => __('bids.not_found'),
    'items' => $bids,
    'search'  => $search,
    'cols' => [
      'id'          => __('bids.row'),
      'date'        => __('bids.date'),
      'NuLL1'       => __('demands.patient_id'),
      'unit_id'     => __('bids.unit_id'),
      'NuLL'        => __('bids.by_you'),
      'status'      => __('bids.status'),
      'show'        => '',
    ]])
    @foreach($bids as $index => $bid)
      <tr class="bid-td {{$bid->joined? 'tr-highlight': ''}}">
        <td>{{$index+1}}</td>
        <td>{{$bid->date_str}}</td>
        <td>{{$bid->demand->patient->full_name}}</td>
        <td><a href="{{route('panel.units.show', ['unit' => $bid->unit])}}">{{$bid->unit->complete_title}}</a></td>
        <td>
          @if($bid->permission_to_operate_bid)
            @if($bid->user_accepted == Bid::P_PENDING)
              <a class="btn btn-warning" href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'refuse'])}}">{{__('bids.refuse')}}</a>
              <a class="btn btn-success" href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'accept'])}}">{{__('bids.accept')}}</a>
            @else
              {{$bid->user_accepted_str}}
            @endif
          @else
            {{$bid->user_accepted_str}}
          @endif
        </td>
        <td>{{$bid->status_str}}</td>
        <td>
          <a class="btn btn-default" href="{{route('panel.bids.show', ['$bid' => $bid])}}">{{__('bids.show')}}</a>
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $bids->links()])
</div>
@endsection
