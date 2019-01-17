@extends('layouts.main')
@section('title', __('reports.index'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  @if(sizeof($report_templates))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>تعداد فیلدها</th>
          <th>وضعیت</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        @foreach($report_templates as $index => $report_template)
          <tr class="rep-td">
            <td>{{$index+1}}</td>
            <td>{{$report_template->title}}</td>
            <td>{{$report_template->field_count}}</td>
            <td>{{$report_template->status_str}}</td>
            <td>
              <form action="{{route('panel.report_templates.destroy', ['report_template' => $report_template])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">حذف</button>
              </form>
              <a href="{{route('panel.report_templates.edit', ['report_template' => $report_template])}}" class="btn btn-info" role="button">ویرایش</a>
              <a href="{{route('panel.report_templates.show', ['report_template' => $report_template])}}" class="btn btn-default" role="button">نمایش</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        هیچ قالب آزمایشی وجود ندارد
      </div>
    </div>
  @endif
  @pagination(['links' => $report_templates->links()])
</div>
@endsection
