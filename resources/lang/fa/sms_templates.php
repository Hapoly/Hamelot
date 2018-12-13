<?php
// sms templates localized in host language that they're sent to cosumers
return [
    'visit' => [
        'new'   => [
            'free_deposit'  => [
                'patient'   => 'نوبت ویزیت شما ثبت شد
GROUP_STR: USER
UNIT
زمان: BID_DATE
شما می‌توانید REMAIN تومان حق ویزیت را به صورت آنلاین یا اینکه نقدا به GROUP_STR پرداخت کنید.',
                'user'      => 'شما یک ویزیت جدید دارید
نام بیمار: PATIENT
واحد: UNIT
زمان: BID_DATE
توجه: لطفا REMAIN تومان هزینه ویزیت را نقدا دریافت نمایید. در صورت پرداخت آنلاین بیمار، شما را مطلع خواهیم کرد
دکترسوال',
            ],
            'paid_deposit'  => [
                'user'      => 'شما یک ویزیت جدید دارید
نام بیمار: PATIENT
واحد: UNIT
زمان: BID_DATE
توجه DEPOSIT تومان بیعانه ویزیت پرداخت شده است، لطفا REMAIN تومان باقی حق ویزیت را نقدا دریافت نمایید. در صورت پرداخت آنلاین بیمار، شما را مطلع خواهیم کرد
دکترسوال',
                'patient'   => 'نوبت ویزیت شما ثبت شد
GROUP_STR: USER
UNIT
زمان: BID_DATE
شما می‌توانید REMAIN تومان باقی حق ویزیت را به صورت آنلاین یا اینکه نقدا به GROUP_STR پرداخت کنید.',
            ],
        ],
        'paid_remain' => [
            'patient'   => 'شما REMAIN تومان باقی هزینه را برای حق ویزیت GENDER یراحی پرداخت کردید. لطفا دیگر هزینه ای نقدا ندهید.',
            'user'      => 'PATIENT REMAIN تومان باقی حق ویزیت خود را آنلاین پرداخت کرد. لطفا هزینه‌ ای دریافت نکنید',
        ],
    ],
];