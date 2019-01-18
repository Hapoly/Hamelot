@extends('layouts.app')
@section('title', $field_template->title)
@section('content')
<div class="container">
  <div class="row" style="direction: rtl;">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="card" style="margin-top: 10px;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12" style="text-align: center;">
                  <h3>{{$field_template->title}}</h3>
                  <h5>واحد:‌ ({{$field_template->unit}})</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="text-align: right;">
                    {{$field_template->description}}
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="margin-top: 15px; text-align: right;">آزمایشات:</div>
                <div class="col-md-12" style="margin-top: 5px;">
                  @foreach($field_template->report_templates as $report)
                    <a href="{{route('show.report', ['slug' => $report->id])}}" class="primary-btn"><span>{{$report->title}}</span></a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @foreach($field_template->ranges as $range)
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="margin-top:10px">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" style="text-align: right;">
                    <h5>درصورتی که {{$field_template->title}} {{$range->mode_str}} {{$range->value}} باشد ({{$range->condition_str}})</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="text-align: justify;">
                    <p>{{$range->description}}</p>
                  </div>
                <div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection