<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ConstValue;

class Consts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // doctors degree
        ConstValue::create(['type'  => 1, 'value' => 'استیجری و پایین تر', ]);
        ConstValue::create(['type'  => 1, 'value' => 'انترن', ]);
        ConstValue::create(['type'  => 1, 'value' => 'رزیدنت', ]);
        ConstValue::create(['type'  => 1, 'value' => 'عمومی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص', ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص', ]);
        // doctors field
        ConstValue::create(['type'  => 2, 'value' => 'فوریت‌های پزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'رادیوتراپی(تکنولوژی پرتودرمانی)', ]);
        ConstValue::create(['type'  => 2, 'value' => 'ارتوپدی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'اطفال', ]);
        ConstValue::create(['type'  => 2, 'value' => 'انفورماتیک', ]);
        ConstValue::create(['type'  => 2, 'value' => 'انکولوژی (سرطان‌شناسی)', ]);
        ConstValue::create(['type'  => 2, 'value' => 'ایمنی‌شناسی و آلرژی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بهداشت عمومی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بیماری‌های اعصاب', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بیماری‌های دهان و دندان', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بیماری‌های ریوی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بینایی‌سنجی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بیهوشی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'فیزیوتراپی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'فیزیولوژی پزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'پاتولوژی (آسیب‌شناسی)', ]);
        ConstValue::create(['type'  => 2, 'value' => 'پرستاری', ]);
        ConstValue::create(['type'  => 2, 'value' => 'طب اورژانس', ]);
        ConstValue::create(['type'  => 2, 'value' => 'خانواده', ]);
        ConstValue::create(['type'  => 2, 'value' => 'مولکولی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'قانونی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'پوست', ]);
        ConstValue::create(['type'  => 2, 'value' => 'تغذیه و رژیم‌درمانی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'جراحی عمومی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'جراحی کلیه و مجاری ادراری', ]);
        ConstValue::create(['type'  => 2, 'value' => 'جراحی مغز و اعصاب', ]);
        ConstValue::create(['type'  => 2, 'value' => 'چشم‌پزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'خون‌شناسی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'داروسازی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'دارورسانی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'دامپزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'دندانپزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'رادیولوژی {تکنولوژی پرتو شناسی}', ]);
        ConstValue::create(['type'  => 2, 'value' => 'روان‌پزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'روماتولوژی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'زنان و زایمان', ]);
        ConstValue::create(['type'  => 2, 'value' => 'ژنتیک', ]);
        ConstValue::create(['type'  => 2, 'value' => 'میکروب شناسی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'طب سنتی / طب حاشیه', ]);
        ConstValue::create(['type'  => 2, 'value' => 'طب فیزیکی و توانبخشی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'طب کار / بهداشت حرفه‌ای', ]);
        ConstValue::create(['type'  => 2, 'value' => 'عفونی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'علوم آزمایشگاهی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'غدد', ]);
        ConstValue::create(['type'  => 2, 'value' => 'قلب و عروق', ]);
        ConstValue::create(['type'  => 2, 'value' => 'کلیه و مجاری ادراری', ]);
        ConstValue::create(['type'  => 2, 'value' => 'گوارش و کبد', ]);
        ConstValue::create(['type'  => 2, 'value' => 'گوش، حلق و بینی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'مامایی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'مدارک پزشکی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'کالبدشناسی / علوم تشریحی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'طب هوانوردی و هوافضا', ]);
        
        // nurses fields
        ConstValue::create(['type'  => 4, 'value' => 'روان پرستاری', ]);
        ConstValue::create(['type'  => 4, 'value' => 'پرستاری ویژه', ]);
        ConstValue::create(['type'  => 4, 'value' => 'بهداشت', ]);
        ConstValue::create(['type'  => 4, 'value' => 'مدیریت', ]);
        ConstValue::create(['type'  => 4, 'value' => 'داخلی جراحی', ]);
        ConstValue::create(['type'  => 4, 'value' => 'اطفال', ]);
        ConstValue::create(['type'  => 4, 'value' => 'آناتومی', ]);
        ConstValue::create(['type'  => 4, 'value' => 'بافت شناسی', ]);
        ConstValue::create(['type'  => 4, 'value' => 'اپیدمیولوژی', ]);

        // nurses degree
        ConstValue::create(['type'  => 3, 'value' => 'لیسانس', ]);
        ConstValue::create(['type'  => 3, 'value' => 'فوق لیسانس', ]);
        ConstValue::create(['type'  => 3, 'value' => 'دکتری', ]);


        // genders
        ConstValue::create(['type'  => 5, 'value' => 'مذکر', ]);
        ConstValue::create(['type'  => 5, 'value' => 'مونث', ]);
    }
}
