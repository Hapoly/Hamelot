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
        // doctors field
        ConstValue::create(['type'  => 1, 'value' => 'فوریت‌های پزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'رادیوتراپی(تکنولوژی پرتودرمانی)', ]);
        ConstValue::create(['type'  => 1, 'value' => 'ارتوپدی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'اطفال', ]);
        ConstValue::create(['type'  => 1, 'value' => 'انفورماتیک', ]);
        ConstValue::create(['type'  => 1, 'value' => 'انکولوژی (سرطان‌شناسی)', ]);
        ConstValue::create(['type'  => 1, 'value' => 'ایمنی‌شناسی و آلرژی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'بهداشت عمومی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'بیماری‌های اعصاب', ]);
        ConstValue::create(['type'  => 1, 'value' => 'بیماری‌های دهان و دندان', ]);
        ConstValue::create(['type'  => 1, 'value' => 'بیماری‌های ریوی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'بینایی‌سنجی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'بیهوشی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'فیزیوتراپی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'فیزیولوژی پزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'پاتولوژی (آسیب‌شناسی)', ]);
        ConstValue::create(['type'  => 1, 'value' => 'پرستاری', ]);
        ConstValue::create(['type'  => 1, 'value' => 'طب اورژانس', ]);
        ConstValue::create(['type'  => 1, 'value' => 'خانواده', ]);
        ConstValue::create(['type'  => 1, 'value' => 'مولکولی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'قانونی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'پوست', ]);
        ConstValue::create(['type'  => 1, 'value' => 'تغذیه و رژیم‌درمانی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'جراحی عمومی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'جراحی کلیه و مجاری ادراری', ]);
        ConstValue::create(['type'  => 1, 'value' => 'جراحی مغز و اعصاب', ]);
        ConstValue::create(['type'  => 1, 'value' => 'چشم‌پزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'خون‌شناسی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'داروسازی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'دارورسانی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'دامپزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'دندانپزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'رادیولوژی {تکنولوژی پرتو شناسی}', ]);
        ConstValue::create(['type'  => 1, 'value' => 'روان‌پزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'روماتولوژی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'زنان و زایمان', ]);
        ConstValue::create(['type'  => 1, 'value' => 'ژنتیک', ]);
        ConstValue::create(['type'  => 1, 'value' => 'میکروب شناسی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'طب سنتی / طب حاشیه', ]);
        ConstValue::create(['type'  => 1, 'value' => 'طب فیزیکی و توانبخشی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'طب کار / بهداشت حرفه‌ای', ]);
        ConstValue::create(['type'  => 1, 'value' => 'عفونی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'علوم آزمایشگاهی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'غدد', ]);
        ConstValue::create(['type'  => 1, 'value' => 'قلب و عروق', ]);
        ConstValue::create(['type'  => 1, 'value' => 'کلیه و مجاری ادراری', ]);
        ConstValue::create(['type'  => 1, 'value' => 'گوارش و کبد', ]);
        ConstValue::create(['type'  => 1, 'value' => 'گوش، حلق و بینی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'مامایی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'مدارک پزشکی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'کالبدشناسی / علوم تشریحی', ]);
        ConstValue::create(['type'  => 1, 'value' => 'طب هوانوردی و هوافضا', ]);
        
        // nurses fields
        ConstValue::create(['type'  => 2, 'value' => 'روان پرستاری', ]);
        ConstValue::create(['type'  => 2, 'value' => 'پرستاری ویژه', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بهداشت', ]);
        ConstValue::create(['type'  => 2, 'value' => 'مدیریت', ]);
        ConstValue::create(['type'  => 2, 'value' => 'داخلی جراحی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'اطفال', ]);
        ConstValue::create(['type'  => 2, 'value' => 'آناتومی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'بافت شناسی', ]);
        ConstValue::create(['type'  => 2, 'value' => 'اپیدمیولوژی', ]);
    }
}
