@extends('layouts.main')
@section('title', __('demands.index_title'))
@section('content')
<div class="row">
  <h2>{{__('demands.index_title')}}</h2>
</div>
<div class="row" style="margin-bottom:50px;">
  @php
    $cols = [];
    $cols['id']           = __('demands.row');
    $cols['description']  = __('demands.description');
    $cols['NuLL1']        = __('addresses.city_id');
    if(!Auth::user()->isPatient())
      $cols['patient_id'] = __('demands.patient_id');
    $cols['status']       = __('demands.status');
    $cols['NuLL2']        = __('demands.operation');
    
  @endphp
  @table([
    'route' => 'panel.demands.index', 
    'hasAny' => sizeof($demands) > 0, 
    'not_found' => __('demands.not_found'),
    'items' => $demands,
    'search'  => $search,
    'cols' => $cols
    ])
    @foreach($demands as $demand)
      <tr class="demand-td {{$demand->joined? 'tr-highlight': ''}}">
        <td>{{$demand->id}}</td>
        <td><a href="{{route('panel.demands.show', ['demand' => $demand])}}">{{$demand->description_summary}}</a></td>
        @if($demand->address_id == 0)
          <td>{{__('demands.no_place')}}</td>
        @else
          <td>{{$demand->address->city->title}}</td>
        @endif
        @if(!Auth::user()->isPatient())
          <td>{{$demand->patient->full_name}}</td>
        @endif
        <td>{{$demand->status_str}}</td>
        <td>
          @if($demand->can_modify)
            <a href="{{route('panel.demands.edit', ['demand' => $demand])}}" class="btn btn-info" role="button">{{__('demands.edit_title')}}</a>
          @endif
          <a class="btn btn-default" href="{{route('panel.demands.show', ['$demand' => $demand])}}">{{__('demands.show')}}</a>
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $demands->links()])
</div>
@endsection
