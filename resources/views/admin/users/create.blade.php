@extends('logged_in_app_layout')
@section('title', 'آزمون جدید')
@section('content')
<div id="content" class="padding-20">
    <div class="col-md-8 col-md-offset-2"> 
      <div class="form-area"> 
        <form  method="post" action="{{route('admin.exams.store')}}" enctype="multipart/form-data">
          @if(sizeof($errors))
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
              {{$error}}
            </div>
            @endforeach
          @endif  
          {{csrf_field()}}
          <div class="form-group row">
              <label for="example-text-input" class="col-3 col-form-label">عنوان </label>
              <div class="col-9">
                <input class="form-control" type="text" name="title" placeholder="عنوان آزمون یا تمرینی که مدنظر دارید" value="{{old('title')}}">
              </div>
          </div>
          <div class="form-group row">
            <label for="subject_id" class="col-3 col-form-label"> کلاس‌درس</label>
            <div class="col-9">
              <select class="form-control" id="subject_id" name="subject_id">
                <option disabled>انتخاب نشده</option>
                @foreach($subjects as $subject)
                  <option value="{{$subject->id}}" {{old('subject_id') == $subject->id? 'selected': ''}}>{{$subject->title}} - {{$grades[$subject->grade]}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="start-date" class="col-3 col-form-label"> تاریخ</label>
            <div class="row">
              <div class="col-md-4"><input class="form-control" type="number" min="1395" max="1405" name="year" placeholder="سال" value="{{old('year')}}"></div>
              <div class="col-md-4"><input class="form-control" type="number" min="1" max="12" name="month" placeholder="ماه" value="{{old('month')}}"></div>
              <div class="col-md-4"><input class="form-control" type="number" min="1" max="31" name="day" placeholder="روز" value="{{old('day')}}"></div>
            </div>
          </div>
          <script>
            function handle(value){
              switch(value){
                case "1":
                  document.getElementById("time-div").style.display = "block";
                  document.getElementById("start-time-div").style.display = "block";
                  document.getElementById("end-time-div").style.display = "block";
                break;
                case "2":
                case "3":
                  document.getElementById("time-div").style.display = "none";
                  document.getElementById("start-time-div").style.display = "block";
                  document.getElementById("end-time-div").style.display = "block";
                break;
                case "4":
                  document.getElementById("time-div").style.display = "none";
                  document.getElementById("start-time-div").style.display = "none";
                  document.getElementById("end-time-div").style.display = "none";
                break;
              }
            }
            $(document).ready(function() {
              console.log('testing!')
              handle(document.getElementById("type").value)
            });
            function showTime(that) {
              handle(that.value)
            }
          </script>
          <div class="form-group row">
            <label for="type" class="col-3 col-form-label"> نوع آزمون</label>
            <div class="col-9">
              <select class="form-control" id="type" name="type" onChange="showTime(this)">
                <option disabled>انتخاب نشده</option>
                <option value="1" {{old('type') == 1? 'selected': ''}}>آزمون آنلاین</option>
                <option value="2" {{old('type') == 2? 'selected': ''}}>آزمون کلاسی</option>
                <option value="3" {{old('type') == 3? 'selected': ''}}>آزمون پایانترم</option>
                <option value="4" {{old('type') == 4? 'selected': ''}}>تمرین کلاسی</option>
              </select>
            </div>
          </div>
          <div class="form-group row" style="display: block" id="time-div">
            <label for="time" class="col-3 col-form-label"> زمان</label>
            <input class="form-control" type="text" name="time" placeholder="حداکثر زمان آزمون به دقیقه" value="{{old('time')}}">
          </div>
          <div class="form-group row" style="display: block" id="start-time-div">
            <label for="start-date" class="col-3 col-form-label"> زمان شروع</label>
            <div class="start-date">
              <div class="row">
                <div class="col-md-4"><input class="form-control" type="number" min="0" max="23" name="start_hour" placeholder="ساعت" value="{{old('start_hour')}}"></div>
                <div class="col-md-4"><input class="form-control" type="number" min="0" max="59" name="start_min" placeholder="دقیقه" value="{{old('start_min')}}"></div>
              </div>
            </div>
          </div>
          <div class="form-group row" style="display: block" id="end-time-div">
            <label for="end-date" class="col-3 col-form-label"> زمان پایان</label>
            <div class="end-date">
              <div class="row">
                <div class="col-md-4"><input class="form-control" type="number" min="0" max="23" name="end_hour" placeholder="ساعت" value="{{old('end_hour')}}"></div>
                <div class="col-md-4"><input class="form-control" type="number" min="0" max="59" name="end_min" placeholder="دقیقه" value="{{old('end_min')}}"></div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="status" class="col-3 col-form-label"> وضعیت</label>
            <div class="col-9">
              <select class="form-control" id="status" name="status">
                <option disabled>انتخاب نشده</option>
                <option value="1" {{old('status') == 1? 'selected': ''}}>فعال</option>
                <option value="2" {{old('status') == 2? 'selected': ''}}>غیرفعال</option>
              </select>
            </div>
          </div>
        <div class="row mt-4">
          <div class="col">
            <input type="submit" name="action" class="btn accent-color text-primary-color " value="ثبت">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection