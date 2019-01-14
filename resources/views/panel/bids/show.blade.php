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
            <td>توضیحات</td>
            <td>{{$bid->description_str}}</td>
          </tr>
          <tr>
            <td>هزینه ویزیت</td>
            <td>{{$bid->price_str}}</td>
          </tr>
          @if(!Auth::user()->isPatient())
            <tr>
              <td>نام بیمار</td>
              <td>{{$bid->demand->patient->full_name}}</td>
            </tr>
            <tr>
              <td>شماره تماس بیمار</td>
              <td>{{$bid->demand->patient->phone}}</td>
            </tr>
          @else
            <tr>
              <td>نام پزشک</td>
              <td>{{$bid->user->full_name}}</td>
            </tr>
            <tr>
              <td>تخضض ها</td>
              <td>{{$bid->user->fields_str}}</td>
            </tr>
          @endif
          @if($bid->deposit > 0)
            <tr>
              <td>بیعانه</td>
              <td>{{$bid->deposit_str}}</td>
            </tr>
          @endif
          <tr>
            <td>{{__('bids.status')}}</td>
            <td>{{$bid->status_str}}</td>
          </tr>
          <tr>
            <td>{{__('bids.date')}}</td>
            <td>{{$bid->date_str}}</td>
          </tr>
          @if($bid->demand->description != 'NuLL')
            <tr>
              <td>{{__('bids.demand_id')}}</td>
              <td><a href="{{route('panel.demands.show', ['demand' => $bid->demand])}}">{{$bid->demand->description_str}}</a></td>
            </tr>
          @endif
          <tr>
            <td>{{__('bids.status')}}</td>
            <td>{{$bid->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      @if(Auth::user()->can('modify', $bid))
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.bids.edit', ['bid' => $bid])}}" class="btn btn-primary" role="button">{{__('bids.edit')}}</a>
        </div>
      @endif
      @if(Auth::user()->can('destroy', $bid))
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.bids.destroy', ['bid' => $bid])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      @endif
      @if(Auth::user()->can('see_providers', $bid))
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('show.user', ['slug' => $bid->demand->user->slug])}}" class="btn btn-default" role="button">{{__('bids.show_user')}}</a>
          <a href="{{route('show.unit', ['slug' => $bid->demand->unit->slug])}}" class="btn btn-default" role="button">{{__('bids.show_unit')}}</a>
        </div>
      @endif
      @if(Auth::user()->can('see_patient', $bid))
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.users.show', ['user' => $bid->demand->patient])}}" class="btn btn-default" role="button">{{__('bids.show_patient')}}</a>
        </div>
      @endif
      @if(Auth::user()->can('operate', $bid))
        <div class="col-md-6" style="text-align: center">
          @if(Auth::user()->can('cancel_by_patient', $bid))
            <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="closeCancelModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="closeCancelModal">لغو نوبت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      ایا مطمعن هستید که میخواهید نوبت خود را لغو کنید؟
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                    <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'cancel'])}}" class="btn btn-danger">لغو</a>
                  </div>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
              {{__('bids.cancel')}}
            </button>
          @endif
          @if(Auth::user()->can('cancel_by_provider', $bid))
            <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="closeCancelModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="closeCancelModal">لغو نوبت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      آیا مطمئن هستید که می خواهید این نوبت ویزیت را لغو کنید؟ برای اطمینان قبل از لغو آن با بیمار تماس بگیرید. شماره تماس: {{$bid->demand->patient->phone}}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                    <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'cancel'])}}" class="btn btn-danger">لغو</a>
                  </div>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
              {{__('bids.cancel')}}
            </button>
          @endif
          @if(Auth::user()->can('finish_by_provider', $bid))
            <div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="closeFinishModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="closeFinishModal">پایان</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    آیا مطمئن هستید که می‌خواهید به این نوبت ویزیت خاتمه دهید؟ ابتدا بیمار باید هزینه ویزیت را نقدی پرداخت کند. در صورتی که دکمه پایان را بزنید، سیستم فرض می کند که بیمار هزینه ویزیت را نقدا پرداخت کرده است.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <a href="{{route('panel.bids.inline_update', ['bid' => $bid, 'action' => 'finish'])}}" class="btn btn-primary">پایان</a>
                  </div>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#finishModal">
              {{__('bids.finish_offline')}}
            </button>
          @endif
        </div>
      @endif
    </div>
  </div>
  <div class="panel panel-default">
    <h3>گزارشات و آزمایش ها</h3>
    @tagline
    گزارشات ثبت شده برای بیمار در رابطه با این دوره درمان
    @endtagline
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
