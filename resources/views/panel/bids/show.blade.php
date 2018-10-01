@extends('layouts.main')
@section('title', __('bids.show_title'))
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('bids.description')}}</td>
            <td>{{$bid->description_str}}</td>
          </tr>
          <tr>
            <td>{{__('demands.patient_id')}}</td>
            <td>{{$bid->demand->patient->full_name}}</td>
          </tr>
          <tr>
            <td>{{__('bids.price')}}</td>
            <td>{{$bid->price_str}}</td>
          </tr>
          <tr>
            <td>{{__('bids.deposit')}}</td>
            <td>{{$bid->deposit_str}}</td>
          </tr>
          <tr>
            <td>{{__('bids.status')}}</td>
            <td>{{$bid->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('bids.date')}}</td>
            <td>{{$bid->date_str}}</td>
          </tr>
          <tr>
            <td>{{__('bids.demand_id')}}</td>
            <td><a href="{{route('panel.demands.show', ['demand' => $bid->demand])}}">{{$bid->demand->description}}</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      @if($bid->can_modify)
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.bids.edit', ['bid' => $bid])}}" class="btn btn-primary" role="button">{{__('bids.edit')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.bids.destroy', ['bid' => $bid])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
      @else
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.show', ['user' => $bid->demand->patient])}}" class="btn btn-default" role="button">{{__('bids.show_patient')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'cancel'])}}" class="btn btn-danger" role="button">{{__('bids.cancel')}}</a>
          <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'finish'])}}" class="btn btn-info" role="button">{{__('bids.finish')}}</a>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
