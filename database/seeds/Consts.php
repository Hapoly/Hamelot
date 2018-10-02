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
        ConstValue::create([
            'type'  => 1,
            'value' => 'انترن',
        ]);
        ConstValue::create([
            'type'  => 1,
            'value' => 'عمومی',
        ]);
        ConstValue::create([
            'type'  => 1,
            'value' => 'متخصص',
        ]);
        ConstValue::create([
            'type'  => 1,
            'value' => 'فوق تخصص',
        ]);

        ConstValue::create([
            'type'  => 2,
            'value' => 'خون',
        ]);
        ConstValue::create([
            'type'  => 2,
            'value' => 'کودکان',
        ]);
        ConstValue::create([
            'type'  => 2,
            'value' => 'عروق',
        ]);
        ConstValue::create([
            'type'  => 2,
            'value' => 'مغز',
        ]);
        ConstValue::create([
            'type'  => 2,
            'value' => 'ارتوپد',
        ]);
        ConstValue::create([
            'type'  => 2,
            'value' => 'کلیه',
        ]);

        ConstValue::create([
            'type'  => 4,
            'value' => 'خون',
        ]);
        ConstValue::create([
            'type'  => 4,
            'value' => 'کودکان',
        ]);
        ConstValue::create([
            'type'  => 4,
            'value' => 'عروق',
        ]);
        ConstValue::create([
            'type'  => 4,
            'value' => 'مغز',
        ]);
        ConstValue::create([
            'type'  => 4,
            'value' => 'ارتوپد',
        ]);
        ConstValue::create([
            'type'  => 4,
            'value' => 'کلیه',
        ]);

        ConstValue::create([
            'type'  => 3,
            'value' => 'پرستار بخش',
        ]);
        ConstValue::create([
            'type'  => 3,
            'value' => 'سوپروایزور',
        ]);

        ConstValue::create([
            'type'  => 5,
            'value' => 'مذکر',
        ]);
        ConstValue::create([
            'type'  => 5,
            'value' => 'مونث',
        ]);
    }
}
