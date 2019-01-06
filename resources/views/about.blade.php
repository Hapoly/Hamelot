@extends('layouts.app')
@section('title', 'درباره ما')
@section('content')
<div class="container">
    <div class="about-sec">
        <h1 class="about-title">دکترسوال چیست و چه هدفی را دنبال میکند؟</h1>
        <div class="about-content">
           <p>
           دکترسوال یک پلتفرم گسترده در حوزه درمان و سلامت عمومی بود که از فروردین ۱۳۹۷ کلید خورد. هدف نهایی این پروژه ارائه بستری برای تمام نیازهای سلامت و بهداشت عموم، اعم از خدمات درمانی، نوبت گیری، پرونده سلامت، اطلاع رسانی و آگاهی سازی، مستندسازی داده‌ها و خدمات اورژانس است. بهداشت و درمان مبحثی حیاتی در تمام جوامع جهانی است و طبق مراکز آماری در هزینه‌ها و بودجه‌ها سومین رتبه را در بین مردم و نهاد‌ها دارد. این موضوع نشانگر اهمیت انکارنشدنی سلامت و بهداشت در جامعه است. در حالی که در سال‌های اخیر علم ‌IT به حوزه‌های مختلف تجاری، صنتعی و فرهنگی ورود کرده و موفق بوده است، با این‌حال همچنان کمبود تمرکز ایشان در حوزه سلامت مشهود است. درمان و اکوسیستم آن در جامعه همچنان از متدهای سنتی دهه پیش تبعیت می‌کند. تجربه ثابت کرده است و استفاده از تکنولوژی و متدهای به روز در مدیریت و اجرا، همواره در بهبود کیفیت و کاهش هزینه‌های خدمات تاثیر داشته است. پروژه دکترسوال در جهت تامین نیازهای درمانی و سلامت جامعه در بستر جدیدترین تکنولوژی‌ها دارد. امید است به هدف خود برسد.
           </p>
           <div class="row">
               <div class="col-md-6">
                <i class="fa fa-phone" aria-hidden="true"></i> : ۰۹۲۱۶۷۲۰۴۹۶
               </div>
               <div class="col-md-6">
                <i class="fa fa-envelope" aria-hidden="true"></i> : info@calcifer.ir
               </div>
           </div>

            <p>
                <i class="fa fa-address-card" aria-hidden="true"></i> :‌ رشت - خیابان معلم - خیابان وحدت - کوچه نسیم - ساختمان سپاس - طبقه چهارم
           </p>
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
        <h1 class="team-title">
            اعضای تیم
        </h1>
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
        <hr>
        <div class="team-member">
            <div class="row">
                <div class="col-md-7">
                    <h3 class="member-name">
                        نوید رضادوست
                    </h3>
                    <p class="member-job">
من کارهای اجرایی تیم رو پیگیری می کنم. با پزشک ها مصاحبه می کنم. محتوی توی سایت و بلاگ می ذارم و رادیو رو می گردونم و از بازار خبر دارم
                    </p>
                </div>
                <div class="col-md-5 team-img-col">
                    <img src="{{asset('members/navid.jpg')}}" class="team-img reza-img">
                </div>
            </div>
        </div>
        <hr>
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
        <hr>
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
        <hr>
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
</div>
@endsection