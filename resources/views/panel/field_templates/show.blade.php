@extends('layouts.main')
@section('title', $report_template->title)
@section('content')
<?php
  use App\User;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $report_template->title }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('reports.title')}}</td>
            <td>{{$report_template->title}}</td>
          </tr>
          <tr>
            <td>{{__('reports.description')}}</td>
            <td>{{$report_template->description}}</td>
          </tr>
          <tr>
            <td>{{__('reports.status')}}</td>
            <td>{{$report_template->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    @if(Auth::user()->isAdmin())
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.report_templates.edit', ['report_template' => $report_template])}}" class="btn btn-primary" role="button">{{__('reports.edit')}}</a>
          <a href="{{route('panel.experiments.create', ['report_template' => $report_template])}}" class="btn btn-info" role="button">{{__('experiments.create')}}</a>
        </div>
        <div class="col-md-6" style="text-align: center">
          <form action="{{route('panel.report_templates.destroy', ['report_template' => $report_template])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">حذف</button>
          </form>
        </div>
      </div>
    @else
      <div class="row">
        <div class="col-md-6" style="text-align: center">
          <a href="{{route('panel.experiments.create', ['report_template' => $report_template])}}" class="btn btn-info" role="button">{{__('experiments.create')}}</a>
        </div>
      </div>
    @endif
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      {{__('reports.fields')}}
    </div>
    @if(sizeof($report_template->fields))
      <table class="table">
        <thead>
          <tr>
            <th>{{__('reports.row')}}</th>
            <th>{{__('reports.title')}}</th>
            <th>{{__('reports.type')}}</th>
            <th>{{__('reports.quantity')}}</th>
            <th>{{__('reports.description')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($report_template->fields as $i=>$field)
            <tr>
              <td>{{$i+1}}</td>
              <td>{{$field->title}}</td>
              <td>{{$field->type_str}}</td>
              <td>{{$field->quantity_str}}</td>
              <td>{{$field->description}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('reports.field_not_found')}}
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
