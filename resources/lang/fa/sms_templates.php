<?php
// sms templates localized in host language that they're sent to cosumers
return [
    'visit' => [
        'new'   => [
            'free_deposit'  => [
                'patient'   => 'نوبت ویزیت شما ثبت شد
GROUP_STR: USER
UNIT
زمان: BID_DATE',
                'user'      => 'شما یک ویزیت جدید دارید
نام بیمار: PATIENT
واحد: UNIT
زمان: BID_DATE',
            ],
            'paid_deposit'  => [
                'user'      => 'شما یک ویزیت جدید دارید
نام بیمار: PATIENT
واحد: UNIT
زمان: BID_DATE',
                'patient'   => 'نوبت ویزیت شما ثبت شد
GROUP_STR: USER
UNIT
زمان: BID_DATE',
            ],
        ],
        'paid_remain' => [
            'patient'   => 'شما REMAIN تومان باقی هزینه را برای حق ویزیت GENDER یراحی پرداخت کردید. لطفا دیگر هزینه ای نقدا ندهید.',
            'user'      => 'PATIENT REMAIN تومان باقی حق ویزیت خود را آنلاین پرداخت کرد. لطفا هزینه‌ ای دریافت نکنید',
        ],
    ],
];