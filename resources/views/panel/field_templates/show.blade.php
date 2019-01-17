@extends('layouts.main')
@section('title', $field_template->title)
@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="row">
      <h2>{{ $field_template->title }}</h2>
    </div>
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>واحد</th>
            <td>{{$field_template->unit}}</td>
          </tr>
          <tr>
            <th>نوع</th>
            <td>{{$field_template->type_str}}</td>
          </tr>
          <tr>
            <th>توضیحات</th>
            <td style="text-align: justify;">{{$field_template->description}}</td>
          </tr>
          <tr>
            <th>وضعیت</th>
            <td>{{$field_template->status_str}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-md-6" style="text-align: center">
        <a href="{{route('panel.field_templates.edit', ['field_template' => $field_template])}}" class="btn btn-primary" role="button">ویرایش</a>
      </div>
      <div class="col-md-6" style="text-align: center">
        <form action="{{route('panel.field_templates.destroy', ['field_template' => $field_template])}}" method="post">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">حذف</button>
        </form>
      </div>
    </div>
  </div>
  @if(sizeof($field_template->ranges))
    <div class="row">
      <div class="col-md-12">
        <h3>توصیفات</h3>
      </div>
    </div>
    @foreach($field_template->ranges as $range)
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 style="text-align:right">درصورتی که {{$field_template->title}} {{$range->mode_str}} {{$range->value}} باشد</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="text-align:right">{{$range->condition_str}}</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <p style="text-align:justify">{{$range->description}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        هیچ توصیفی برای این فیلد ثبت نشده است
      </div>
    </div>
  @endif
</div>
@endsection
