@extends('layouts.main')
@section('title', __('bids.create_title'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.bids.store'), 'title' => __('bids.create_title')])
    <div class="row">
      <div class="col-md-12" style="text-align: center">{{__('bids.for_demand')}} <a href="{{route('panel.demands.show' ,['demand' => $demand])}}">{{$demand->description_str}}</a></div>
    </div>
    <input type="hidden" name="demand_id" value="{{$demand->id}}" />
    @input_text(['name' => 'description', 'value' => old('description', ''), 'label' => __('bids.description'), 'required' => false])
    @input_date_complete(['name' => 'date', 'label' => __('bids.date'), 'value'  => old('date', time()), 'required' => true])
    @input_currency(['name' => 'price', 'value' => old('price', ''), 'label' => __('bids.price'), 'required' => true, 'min' => 1, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn')])
    @input_currency(['name' => 'deposit', 'value' => old('deposit', ''), 'label' => __('bids.deposit'), 'required' => true, 'min' => 1, 'max' => 9999999, 'step' => 1, 'placeholder' => __('general.tmn')])
    @tagline
      {{__('bids.price_description')}}
    @endtagline
    @php
      $target_rows = [];
      foreach($units as $unit){
        foreach($unit->members as $user){
          array_push($target_rows, [
            'value' => $unit->id . '.' . $user->id,
            'label' => $unit->title . ' - ' . $user->full_name
          ]);
        }
      }
    @endphp
    @input_select(['name' => 'target', 'value' => old('target', ''), 'label' => __('bids.target'), 'required' => true, 'rows' => $target_rows])
    @submit_row(['value' => 'new', 'label' => __('bids.save')])
  @endform_create
</div>
@endsection