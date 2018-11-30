@extends('layouts.main')
@section('title', __('demands.create_title'))
@section('content')
<?php
  use App\Models\Address;
  use App\Models\ActivityTime;
?>
<div class="container">
  @form_create(['action' => route('panel.demands.store.visit', ['activity_time' => $activity_time, 'day' => $day]), 'title' => __('demands.create')])
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('demands.unit_id')}}</td>
            <td>{{$activity_time->unit_user->unit->complete_title}}</td>
          </tr>
          <tr>
            <td>{{__('demands.user_id')}}</td>
            <td>{{$activity_time->unit_user->user->full_name}}</td>
          </tr>
          <tr>
            <td>{{__('activity_times.time')}}</td>
            <td>{{$date}}, {{$activity_time->time_str}}</td>
          </tr>
          <tr>
            <td>{{__('activity_times.default_price')}}</td>
            <td>{{$activity_time->default_price_str}}</td>
          </tr>
          <tr>
            <td>{{__('activity_times.default_deposit')}}</td>
            <td>{{$activity_time->default_deposit_str}}</td>
          </tr>
          <tr>
            <td>{{__('activity_times.default_demand_time')}}</td>
            <td>{{$activity_time->default_demand_time_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @input_text(['name' => 'description', 'value' => old('description', ''), 'label' => __('demands.description'), 'required' => false, 'row' => true])
    @if($activity_time->just_in_unit_visit == ActivityTime::UNIT_ADDRESS || $activity_time->just_in_unit_visit == ActivityTime::IN_ADDRESS)
      @php
        $address_rows = [];
        if($activity_time->just_in_unit_visit == ActivityTime::UNIT_ADDRESS)
          array_push($address_rows, [
            'value' => 0,
            'label' => __('demands.no_address'),
          ]);
        if(Auth::user()->isAdmin()){
          $addresses = Address::all();
          for($i=0; $i<sizeof($addresses); $i++){
            array_push($address_rows, [
              'value' => $addresses[$i]->id,
              'label' => $addresses[$i]->title . ' ('. $addresses[$i]->user->full_name .')'
            ]);
          }
        }else{
          $addresses = Auth::user()->addresses;
          for($i=0; $i<sizeof($addresses); $i++){
            array_push($address_rows, [
              'value' => $addresses[$i]->id,
              'label' => $addresses[$i]->title
            ]);
          }
        }
      @endphp
      @input_select(['name' => 'address_id', 'value' => old('address_id', ''), 'label' => __('demands.address_id'), 'required' => true, 'rows' => $address_rows, 'row' => true])
    @endif
    <div class="row">
        <div class="col-md-12" style="text-align: center">
          @if($activity_time->default_deposit == 0)
            <button type="submit" id="submit" class="btn btn-primary" name="action" value="pay">{{__('demands.save')}}</button>  
          @else
            <button type="submit" id="submit" class="btn btn-primary" name="action" value="pay">{{__('demands.visit_pay_deposit')}}</button>
          @endif
        </div>
    </div>
  @endform_create
</div>
@endsection