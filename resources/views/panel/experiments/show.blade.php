@extends('layouts.main')
@section('title', $experiment->report_template->title . ' - ' . $experiment->user->first_name_str . ' ' . $experiment->user->last_name_str)
@section('content')
<?php
  use App\User;
?>
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <div class="col-md-4" style="text-align: center;" >{{__('reports.title')}}: {{$experiment->report_template->title}}</div>
      <div class="col-md-4" style="text-align: center;" >{{__('experiments.user_id')}}: {{$experiment->user->first_name_str}} {{$experiment->user->last_name_str}}</div>
      <div class="col-md-4" style="text-align: center;" >{{__('experiments.date')}}: {{$experiment->date_str}}</div>
      <div class="col-md-4" style="text-align: center; margin-top: 15px;" >{{__('experiments.unit_id')}}: {{$experiment->unit->complete_title}}</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="row">
      <table class="table table-striped">
        <tbody>
          @foreach($experiment->fields as $field)
            <tr>
              <td>{{$field->title}}</td>
              <td>{{$field->literal_value}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.experiments.edit', ['experiment' => $experiment])}}" class="btn btn-primary" role="button">{{__('experiments.edit')}}</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.experiments.destroy', ['experiment' => $experiment])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.experiments.show', ['experiment' => $experiment])}}">{{__('experiments.print')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection
