@extends('logged_in_app_layout')
@section('title', 'آزمون - ' . $exam->title)
@section('content')
<div id="content" class="padding-20">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div id="no-more-tables">
        <table class="col-md-12 table-bordered table-striped table-condensed cf">
          <tbody>
            <tr>
              <th>عنوان</th>
              <td>{{$exam->title}}</td>
            </tr>
            <tr>
              <th>کلاس‌درس</th>
              <td><a href="{{route('admin.subjects.show', ['subject' => $exam->subject])}}">{{$exam->subject->title}} {{$grades[$exam->subject->grade]}}</a></td>
            </tr>
            <tr>
              <th>نوع</th>
              <td>{{$exam->get_type()}}</td>
            </tr>
            @if($exam->type == 1)
              <tr>
                <th>زمان</th>
                <td>{{$exam->time}} دقیقه</td>
              </tr>
              <tr>
                <th>شروع</th>
                <td>{{\App\Drivers\Time::jdate('d/m/Y - h:i a', $exam->start_date)}}</td>
              </tr>
              <tr>
                <th>پایان</th>
                <td>{{\App\Drivers\Time::jdate('d/m/Y - h:i a', $exam->end_date)}}</td>
              </tr>
            @endif
            <tr>
              <th>وضعیت</th>
              <td>{{$exam->get_status()}}</td>
            </tr>
            <tr>
              <th>عملیات</th>
              <td>
                <form action="{{route('admin.exams.destroy', ['exam' => $exam])}}" style="display: inline" method="POST" class="trash-icon">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">حذف</button>
                </form>
                <a href="{{route('admin.exams.edit', ['exam' => $exam])}}" class="btn btn-info" role="button">ویرایش</a>
                @if($exam->type == 1)
                  <a href="{{route('admin.questions.index', ['exam_id' => $exam])}}" class="btn btn-primary" role="button">سوالات</a>
                @endif
                <a href="{{route('admin.scores.show', ['exam' => $exam])}}" class="btn btn-primary" role="button">نمرات</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection