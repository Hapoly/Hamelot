@extends('layouts.main')
@section('title', $experiment->report_template->title . ' - ' . $experiment->user->first_name . ' ' . $experiment->user->last_name)
@section('content')
<?php
  use App\User;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('reports.title')}}</td>
            <td>{{$experiment->report_template->title}}</td>
          </tr>
          <tr>
            <td>{{__('experiments.date')}}</td>
            <td>{{$experiment->date_str}}</td>
          </tr>
          <tr>
            <td>{{__('experiments.patient_name')}}</td>
            <td>{{$experiment->user->first_name}} {{$experiment->user->last_name}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="row">
      <table class="table table-striped">
        <tbody>
          @foreach($experiment->fields as $field)
            <tr>
              <td>{{$field->title}}</td>
              <td>{{$field->value}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
