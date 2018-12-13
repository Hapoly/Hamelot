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
        ConstValue::create(['type'  => 1, 'value' => 'متخصص اطفال' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص زنان' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص ارتوپد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص پوست' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص انکلوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص داخلی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص قلب' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص مغز و اعصاب' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص گوش حلق و بینی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص متخصص رادیولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص غدد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص تغذیه' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص پزشکی قانونی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص بیهوشی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص روماتولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص دندانپزشک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص ژنتیک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص عفونی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص مامایی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص روانپزشکی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص ارولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص فیزیوتراپی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص طب فیزیک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص پزشکی ورزشی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص طب اورژانس' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص داروساز' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص چشم' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص روانشناسی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص اسیب شناس' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص ایمنولوژی و الرژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص طب تسکینی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص پرتو درمانی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'متخصص طب سنتی' ]);

        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص کبد و گوارش' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص خون و انکلوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص کلیه' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص روماتولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص غدد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص قلب و عروق' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص ریه' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص عفونی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص گوش حلق و بینی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص رادیولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص تغذیه' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص پزشکی قانونی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص بیهوشی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص ژنتیک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص دندانپزشکی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص روانپزشکی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص ارولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص فیزیوتراپی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص طب فیزیک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص روانشناسی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص داروساز' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص طب اورژانس' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص پزشکی ورزشی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص اسیب شناسی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص چشم' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص ایمنولوژی و الرژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص طب تسکینی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص ارتوپد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص زنان' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص پوست' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فوق تخصص اطفال' ]);
        
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی پوست' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی پلاستیک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراح ستون فقرات' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی قلب و عروق' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ گوش حلق و بینی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی چشم' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی پوست' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی ترمیمی دهان و فک و صورت' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی زنان' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ غدد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراح گوارش' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی ارولوژی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی اطفال' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی ارتوپد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی ستون فقرات' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی دست' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی بینی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ جراحی زیبایی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'فلوشیپ نازایی' ]);
        
        ConstValue::create(['type'  => 1, 'value' => 'پزشک عمومی' ]);
        ConstValue::create(['type'  => 1, 'value' => 'جراح' ]);
        ConstValue::create(['type'  => 1, 'value' => 'غدد' ]);
        ConstValue::create(['type'  => 1, 'value' => 'قلب' ]);
        ConstValue::create(['type'  => 1, 'value' => 'پلاستیک' ]);
        ConstValue::create(['type'  => 1, 'value' => 'پوست' ]);
        ConstValue::create(['type'  => 1, 'value' => 'ستون فقرات' ]);
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
