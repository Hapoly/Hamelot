@extends('layouts.main')
@section('title', __('reports.index'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  @if(sizeof($field_templates))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>وضعیت</th>
          <th >عملیات</th>
        </tr>
      </thead>
      <tbody>
        @foreach($field_templates as $index => $field_template)
          <tr class="rep-td">
            <td>{{$index+1}}</td>
            <td>{{$field_template->title}}</td>
            <td>{{$field_template->status_str}}</td>
            <td>
              <form action="{{route('panel.field_templates.destroy', ['field_template' => $field_template])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">حذف</button>
              </form>
              <a href="{{route('panel.field_templates.edit', ['field_template' => $field_template])}}" class="btn btn-info" role="button">ویرایش</a>
              <a href="{{route('panel.field_templates.show', ['field_template' => $field_template])}}" class="btn btn-default" role="button">نمایش</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        هیچ فیلدی پیدا نشد.
      </div>
    </div>
  @endif
  @pagination(['links' => $field_templates->links()])
</div>
@endsection
