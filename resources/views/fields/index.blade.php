@extends('layouts.app')
@section('title', 'آزمایش خوانی')
@section('content')
<div class="container">
  <div class="row" style="direction: rtl;">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <h1 style="text-align: center;">چگونه برگه های آزمایش خود را تفسیر کنیم؟</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10" >
          <p style="text-align: justify; font-size: 16px; margin-top: 20px;">
            بسیاری مواقع پیش آمده که پس از دریافت برگه آزمایش از آزمایشگاه یا بیمارستان علاقه داریم که آنرا به تنهایی بخوانیم و در حد کمی از وضعیت سلامت خود مطلع شویم. اما برگه های آزمایش مملو از اصطلاحات و کلمات پیچیده و ناآشنای پزشکی هستند که تفاسیر مختلفی دارند. در این صفحه شما می توانید اصطاحات خود را جستجو کرده و درباره آنها مطالعه دقیق تری داشته باشید. کافیست عنوان مولفه هایی که در برگه آزمایش خود دارید را اینجا وارد کنید.
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-sm-12">
        </div>
        <div class="col-md-8 col-sm-12">
          <form action="{{route('fields.result')}}">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="term" placeholder="عنوان فیلد یا نام فارسی آن" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="text-align: center">
                <button type="submit" class="btn btn-primary">جستجو</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection