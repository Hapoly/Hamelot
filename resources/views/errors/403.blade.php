@extends('layouts.app')
@section('title', 'خطای ۴۰۳')
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-12"></div>
    <div class="col-md-6 col-sm-12">
        <div class="login-card" style="text-align: right">
            <h4 dir="rtl" style="text-align: justify;">محتوی مورد نظر برای سطح دسترسی شما نیست!</h4>
            <p dir="rtl">صفحه یا محتوی موردنظر در دسترس شما نیست. احتمالا یکی از دلایل زیر منجر به بروز خطای ۴۰۳ شده است:</p>
            <ul dir="rtl">
                <li>آدرس مورد نظر وجود خارجی ندارد یا دیگر وجود ندارد.</li>
                <li>شما با سطح کاربری نامناسب اقدام به انجام عملیاتی در سطح دیگر کرده اید (برای مثال با حساب کاربری پزشک می خواستید نوبت بگیرید).</li>
                <li>این صفحه به صورت موقت ساخته شده بود و الان دیگر وجود ندارد.</li>
            </ul>
            <p dir="rtl">در صورتی که مشکل از دلایل ذکر شده نبود لطفا با وب مستر (info@doctorsoal.com) تماس بگیرید. با تشکر</p>
        </div>
    </div>
</div>
@endsection