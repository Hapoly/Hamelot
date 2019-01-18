@extends('layouts.app')
@section('title', 'آزمایش خوانی')
@section('content')
<div class="container">
  <div class="row" style="direction: rtl;">
    <div class="col-md-12">
      <div class="row">
        @foreach($fields as $field)
          <div class="col-md-4 col-sm-6">
            <div class="card" style="margin-top: 10px;">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" style="text-align: center;">
                    <a style="color: black;" href="{{route('show.field', ['field_template' => $field])}}"><h3>{{$field->title}}</h3></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="text-align: right;">
                    واحد: {{$field->unit}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="margin-top: 15px; text-align: right;">آزمایشات:</div>
                  <div class="col-md-12" style="margin-top: 5px;">
                    @foreach($field->report_templates as $report)
                      <a href="{{route('show.report', ['report_template' => $report])}}" class="primary-btn"><span>{{$report->title}}</span></a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection