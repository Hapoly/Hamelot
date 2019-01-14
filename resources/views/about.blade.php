@extends('layouts.app')
@section('title', 'درباره ما')
@section('content')
<div class="container">
  <div class="about-sec">
    <h1 class="about-title">دکترسوال چیست و چه هدفی را دنبال میکند؟</h1>
    <div class="about-content">
      <p>
        دکترسوال یک سامانه پزشکی آنلاینه که به مردم کمک میکنه مشکلات پزشکی خودشون رو به آسانی با پزشکان درمیون بزارن. در حال حاضر در گروه تلگرام دکترسوال به پرسش های پزشکی شما به رایگان پاسخ میدیم. علاوه بر این افرادی که نیاز داشته باشن بصورت خصوصی با یک پزشک صحبت کنن ما اونا رو به پزشک مورد نظر متصل میکنیم.
      </p>
      <h3>
        چرا از دکترسوال استفاده کنم؟
      </h3>
      <p>
        بخاطر اینکه دکترسوال در وقت و هزینه شما صرفه جویی میکنه. این شعار نیست چون خیلی اوقات برای خودمونم پیش اومده که یه مشکل پزشکی داشتیم ولی هم فرصت مراجعه به پزشک رو نداشتیم هم از حق ویزیت بالای مطب میترسیدیم 🙂 بعضی اوقات پیش اومده افرادی برای مشاوره خصوصی به ما مراجعه میکنن که پزشک متخصص مناسبی رو نمیشناسن. گذشته ازین منطقی به نظر نمیرسه بخاطر یه سوال یا شک و شبهه کوچیک از وقتتون بزنین هزینه هم بکنین و تا بیمارستان و درمانگاه و یا مطب برین .
      </p>
      <h3>
        ما کی هستیم؟
      </h3>
      <p>
        تعدادی جوون خلاق و پر انرژی که یکی از مشکلات جامعه رو شناسایی و براش راه حلی پیدا کردن. اسم همه افرادی که دارن کمک میکنن تا شما به راحتی با پزشکان ارتباط برقرار کنید رو در زیر نوشتیم.
      </p>
      <div class="row">
        <div class="col-md-6">
          <i class="fa fa-phone" aria-hidden="true"></i> : ۰۹۹۱۰۸۴۵۶۴۶  
        </div>
        <div class="col-md-6">
          <i class="fa fa-envelope" aria-hidden="true"></i> : info@doctorsoal.com
        </div>
      </div>
    </div>
    <div class="arrow-down">
      <a href="#ex" id="mybtn">
        <button class="btn arrow-btn">
          <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </button>      
      </a>
    </div>
  </div>
  <div id="ex">
    <h1 class="team-title">اعضای تیم</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                  مهدی مرتضوی
              </h3>
              <p class="member-job">
                طراح رابط و تجربه کاربری دکترسوال هستم. من اینجا هستم تا دکتر سوال منطبق با نیاز و خواست کاربرانش طراحی و توسعه داده بشه. وظیفه هماهنگی و مدیریت تیم هم با منه.
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/mehdi.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                نوید رضادوست
              </h3>
              <p class="member-job">
                من موشن گرافیست تیم هستم و کار های تولید محتوا و سئو محتوا رو انجام میدم و به کار تیم اجرایی دکتر سوال نظارت دارم
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/navid.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                فرزین میرزایی
              </h3>
              <p class="member-job">
                من برنامه نویس موبایل تیم هستم. همینطور به مدیریت کارهای بقیه بچه های تیم و تعیین و زمانبندی وظایفشون مشغولم
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/farzin.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                ایمان خالق پرست
              </h3>
              <p class="member-job">
                من توسعه دهنده تعاملی تیم هستم.روی امکانات جدیدی که تو سایت میبینید کار میکنم. در کنارش تو تست سیستم و بهبود ظاهر سایت کمک میکنم.
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/shayan.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                علیرضا دربندی
              </h3>
              <p class="member-job">
                من توسعه دهنده هسته پروژه هستم. برنامه نویسی هسته پروژه رو انجام می دم و مستندات کتابخونه ها رو می نویسم.
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/reza.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                فاطمه ضیائبخش
              </h3>
              <p class="member-job">
                منشی پزشک، ادمین کانال
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/fatemeh.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                فرزانه ابوچناری
              </h3>
              <p class="member-job">
                کارشناس نرم افزار،سرپرست تیم اجرایی،منشی پزشک ،پشتیبانی ،ویزیتور
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/farzaneh.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                زینب خیرجو
              </h3>
              <p class="member-job">
                منشی پزشک
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/zeinab.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="team-member">
          <div class="row">
            <div class="col-md-7">
              <h3 class="member-name">
                زهره خیرجو
              </h3>
              <p class="member-job">
                منشی پزشک
              </p>
            </div>
            <div class="col-md-5 team-img-col">
              <img src="{{asset('members/zohre.jpg')}}" class="team-img reza-img">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection