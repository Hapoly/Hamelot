@extends('layouts.main')
@section('title', $demand->description_str)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('demands.description')}}</td>
            <td>{{$demand->description_str}}</td>
          </tr>
          <tr>
            <td>{{__('demands.patient_id')}}</td>
            <td>{{$demand->patient->full_name}}</td>
          </tr>
          @if($demand->address_id == 0)
            <tr>
              <td>{{__('demands.address_type')}}
              <td>{{__('demands.no_place')}}</td>
            </tr>
          @else
            <tr>
              <td>{{__('addresses.province_id')}}</td>
              <td>{{$demand->address->city->province->title}}</td>
            </tr>
            <tr>
              <td>{{__('addresses.city_id')}}</td>
              <td>{{$demand->address->city->title}}</td>
            </tr>
            <tr>
              <td>{{__('addresses.plain')}}</td>
              <td>{{$demand->address->plain}}</td>
            </tr>
            <tr>
              <td>{{__('addresses.cordinate_link')}}</td>
              <td><a target="_blank" href="https://www.google.com/maps/{{'@' .$demand->address->lon}},{{$demand->address->lat}},18z">{{__('addresses.show_on_gmaps')}}</a></td>
            </tr>
          @endif
          <tr>
            <td>{{__('demands.time')}}</td>
            @if($demand->asap)
              <td>{{__('demands.is_asap')}}</td>
            @else
              <td>{{$demand->start_date_time_str}} {{__('demands.date_to_date')}} {{$demand->end_date_time_str}}</td>
            @endif
          </tr>
          @if($demand->choosenBid())
            <tr>
              <td>{{__('bids.unit_id')}}</td>
              <td>{{$demand->unit->complete_title}}</td>
            </tr>
            <tr>
              <td>{{__('bids.user_id')}}</td>
              <td>{{$demand->user->full_name}}</td>
            </tr>
            <tr>
              <td>{{__('bids.date')}}</td>
              <td>{{$demand->choosenBid()->date_str}}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
    @if($demand->can_modify)
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          <a class="btn btn-primary" href="{{route('panel.demands.edit', ['demand' => $demand])}}">{{__('demands.edit_title')}}</a>
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      @if($demand->has_permission_to_bid)
        <a href="{{route('panel.bids.create', ['demand' => $demand])}}" class="btn btn-primary sub-panel-add"><i class="fa fa-plus"></i></a>
      @endif
      {{__('bids.index_title')}}
    </div>
    @if(sizeof($demand->my_bids()->get()))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('bids.row')}}</th>
            <th>{{__('bids.date')}}</th>
            <th>{{__('bids.unit_id')}}</th>
            <th>{{__('bids.user_id')}}</th>
            <th>{{__('bids.price')}}</th>
            <th>{{__('bids.deposit')}}</th>
            <th><th>
          </tr>
        </thead>
        <tbody>
          @foreach($demand->my_bids()->get() as $index => $bid)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$bid->date_str}}</td>
              <td>{{$bid->unit->complete_title}}</td>
              <td>{{$bid->user->full_name}}</td>
              <td>{{$bid->price_str}}</td>
              <td>{{$bid->deposit_str}}</td>
              @if($bid->permission_to_operate_bid)
                <td>
                  @if(Auth::user()->isManager())
                    <a class="btn btn-danger" href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'delete'])}}">{{__('bids.delete')}}</a>
                  @endif
                  <a class="btn btn-warning" href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'refuse'])}}">{{__('bids.refuse')}}</a>
                  @if(Auth::user()->isPatient())
                    <a class="btn btn-success" href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'accept'])}}">{{__('bids.accept')}}</a>
                  @endif
                </td>
              @else
                <td>{{$bid->status_str}}</td>
              @endif
              <td><a href="{{route('panel.bids.show', ['bid' => $bid])}}" class="btn btn-default">{{__('bids.show')}}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('bids.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
