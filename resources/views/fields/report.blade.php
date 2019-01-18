@extends('layouts.app')
@section('title', $report_template->title)
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
                  <h3>{{$report_template->title}}</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="text-align: right;">
                    {{$report_template->description}}
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="margin-top: 15px; text-align: right;">فیلدها:</div>
                <div class="col-md-12" style="margin-top: 5px;">
                  @foreach($report_template->fields as $field)
                    <a href="{{route('show.field', ['slug' => $field->id])}}" class="primary-btn"><span>{{$field->title}}</span></a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection