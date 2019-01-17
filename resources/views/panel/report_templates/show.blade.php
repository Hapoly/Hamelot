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
            <th>عنوان</th>
            <td>{{$report_template->title}}</td>
          </tr>
          <tr>
            <th>توضیحات</th>
            <td>{{$report_template->description}}</td>
          </tr>
          <tr>
            <th>وضعیت</th>
            <td>{{$report_template->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.report_templates.edit', ['report_template' => $report_template])}}" class="btn btn-primary" role="button">ویرایش</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.report_templates.destroy', ['report_template' => $report_template])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading sub-panel-title">
      فیلدها
    </div>
    @if(sizeof($report_template->fields))
      <table class="table">
        <thead>
          <tr>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>نوع</th>
            <th>واحد</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($report_template->fields as $i=>$field)
            <tr>
              <td>{{$i+1}}</td>
              <td>{{$field->title}}</td>
              <td>{{$field->type_str}}</td>
              <td>{{$field->unit}}</td>
              <td>
                <a class="btn btn-default" href="{{route('panel.field_templates.show', ['field_template' => $field])}}">مشاهده</a>
                <a class="btn btn-warning" href="{{route('panel.report_fields.remove', ['report_field' => $field->pivot->id])}}">حذف</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          این آزمایش هیچ فیلدی ندارد
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
