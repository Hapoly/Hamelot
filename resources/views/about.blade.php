@extends('layouts.app')
@section('content')
<div class="container">
    <div class="about-sec">
        <h1 class="about-title">کالسیفر چیست و چه هدفی را دنبال میکند؟</h1>
        <div class="about-content">
           <p>
           کالسیفر یک پلتفرم گسترده در حوزه درمان و سلامت عمومی بود که از فروردین ۱۳۹۷ کلید خورد. هدف نهایی این پروژه ارائه بستری برای تمام نیازهای سلامت و بهداشت عموم، اعم از خدمات درمانی، نوبت گیری، پرونده سلامت، اطلاع رسانی و آگاهی سازی، مستندسازی داده‌ها و خدمات اورژانس است. بهداشت و درمان مبحثی حیاتی در تمام جوامع جهانی است و طبق مراکز آماری در هزینه‌ها و بودجه‌ها سومین رتبه را در بین مردم و نهاد‌ها دارد. این موضوع نشانگر اهمیت انکارنشدنی سلامت و بهداشت در جامعه است. در حالی که در سال‌های اخیر علم ‌IT به حوزه‌های مختلف تجاری، صنتعی و فرهنگی ورود کرده و موفق بوده است، با این‌حال همچنان کمبود تمرکز ایشان در حوزه سلامت مشهود است. درمان و اکوسیستم آن در جامعه همچنان از متدهای سنتی دهه پیش تبعیت می‌کند. تجربه ثابت کرده است و استفاده از تکنولوژی و متدهای به روز در مدیریت و اجرا، همواره در بهبود کیفیت و کاهش هزینه‌های خدمات تاثیر داشته است. پروژه کالسیفر در جهت تامین نیازهای درمانی و سلامت جامعه در بستر جدیدترین تکنولوژی‌ها دارد. امید است به هدف خود برسد.
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
                            علیرضا دربندی
                        </h3>
                        <p class="member-job">
                            توسعه دهنده وب
                        </p>
                        <p class="member-job">
                            Back-End Developer
                        </p>
                    </div>
                    <div class="col-md-5 team-img-col">
                        <img src="/imgs/reza.jpg" class="team-img reza-img">
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="team-member">
                <div class="row">
                    <div class="col-md-5">
                        <img src="/imgs/sadaf.jpg" class="team-img sadaf-img">
                    </div>
                    <div class="col-md-7">
                        <h3 class="member-name">
                            صدف نجفی خواه
                        </h3>
                        <p class="member-job">
                            توسعه دهنده وب
                        </p>
                        <p class="member-job">
                            Front-End Developer
                        </p>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection