@extends('layouts.main')
@section('title', __('bids.show_title'))
@section('content')
@php
  use App\Models\Bid;
@endphp
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
          <tr>
            <td>{{__('bids.status')}}</td>
            <td>{{$bid->status_str}}</td>
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
        @if(!$bid->finished)
          @if(Auth::user()->isPatient())
            <div class="col-md-6" style="text-align: center">
              <a href="{{route('panel.users.show', ['user' => $bid->demand->user])}}" class="btn btn-default" role="button">{{__('bids.show_user')}}</a>
              <a href="{{route('panel.units.show', ['unit' => $bid->demand->unit])}}" class="btn btn-default" role="button">{{__('bids.show_unit')}}</a>
            </div>
            @if(!$bid->permission_to_operate_bid)
            <div class="col-md-6" style="text-align: center">
              <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'cancel'])}}" class="btn btn-danger" role="button">{{__('bids.cancel')}}</a>
              <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'finish'])}}" class="btn btn-info" role="button">{{__('bids.finish')}}</a>
              @if($bid->status != Bid::ACCEPTED_PAID_ALL)
                <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'pay_remain'])}}" class="btn btn-info" role="button">{{__('bids.pay_remain')}}</a>
              @endif
            </div>
            @endif
          @else
            <div class="col-md-6" style="text-align: center">
              <a href="{{route('panel.users.show', ['user' => $bid->demand->patient])}}" class="btn btn-default" role="button">{{__('bids.show_patient')}}</a>
              <a href="{{route('panel.report_templates.index', ['bid'  => $bid])}}" class="btn btn-info" role="button">{{__('bids.add_experiment')}}</a>
            </div>
            @if(!$bid->permission_to_operate_bid)
            <div class="col-md-6" style="text-align: center">
              <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'cancel'])}}" class="btn btn-danger" role="button">{{__('bids.cancel')}}</a>
              <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'finish-offline'])}}" class="btn btn-info" role="button">{{__('bids.finish_offline')}}</a>
            </div>
            @endif
          @endif
        @else
          <div class="col-md-12" style="text-align: center">
            <a href="{{route('panel.users.show', ['user' => $bid->demand->patient])}}" class="btn btn-default" role="button">{{__('bids.show_patient')}}</a>
          </div>
        @endif
      @endif
    </div>
  </div>
  <div class="panel panel-default">
    <h2>{{__('experiments.index_title')}}</h2>
    @tagline{{__('experiments.tag_line_patients')}}@endtagline
    @if(sizeof($bid->experiments))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('experiments.row')}}</th>
            <th>{{__('experiments.title')}}</th>
            <th>{{__('experiments.date')}}</th>
            <th></th>
            <th>{{__('experiments.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bid->experiments as $experiment)
            <tr>
              <td>{{$experiment->id}}</td>
              <td><a href="{{route('panel.report_templates.show', ['report_template' => $experiment->report_template])}}">{{$experiment->report_template->title}}</a></td>
              <td>{{$experiment->date_str}}</td>
              @if($experiment->can_modify)
                <td>
                  @operation_th(['base' => 'panel.experiments', 'label' => 'user', 'item' => $experiment, 'remove_label' => __('experiments.remove'), 'edit_label' => __('experiments.edit'), 'show_label' => __('experiments.show')])
                </td>
              @else
                <td>-</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('experiments.not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
