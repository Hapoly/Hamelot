<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Consts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consts')->insert([
            'type'  => 1,
            'value' => 'انترن',
        ]);
        DB::table('consts')->insert([
            'type'  => 1,
            'value' => 'عمومی',
        ]);
        DB::table('consts')->insert([
            'type'  => 1,
            'value' => 'متخصص',
        ]);
        DB::table('consts')->insert([
            'type'  => 1,
            'value' => 'فوق تخصص',
        ]);

        DB::table('consts')->insert([
            'type'  => 2,
            'value' => 'خون',
        ]);
        DB::table('consts')->insert([
            'type'  => 2,
            'value' => 'کودکان',
        ]);
        DB::table('consts')->insert([
            'type'  => 2,
            'value' => 'عروق',
        ]);
        DB::table('consts')->insert([
            'type'  => 2,
            'value' => 'مغز',
        ]);
        DB::table('consts')->insert([
            'type'  => 2,
            'value' => 'ارتوپد',
        ]);
        DB::table('consts')->insert([
            'type'  => 2,
            'value' => 'کلیه',
        ]);

        DB::table('consts')->insert([
            'type'  => 4,
            'value' => 'خون',
        ]);
        DB::table('consts')->insert([
            'type'  => 4,
            'value' => 'کودکان',
        ]);
        DB::table('consts')->insert([
            'type'  => 4,
            'value' => 'عروق',
        ]);
        DB::table('consts')->insert([
            'type'  => 4,
            'value' => 'مغز',
        ]);
        DB::table('consts')->insert([
            'type'  => 4,
            'value' => 'ارتوپد',
        ]);
        DB::table('consts')->insert([
            'type'  => 4,
            'value' => 'کلیه',
        ]);

        DB::table('consts')->insert([
            'type'  => 3,
            'value' => 'پرستار بخش',
        ]);
        DB::table('consts')->insert([
            'type'  => 3,
            'value' => 'سوپروایزور',
        ]);

        DB::table('consts')->insert([
            'type'  => 5,
            'value' => 'مذکر',
        ]);
        DB::table('consts')->insert([
            'type'  => 5,
            'value' => 'مونث',
        ]);
    }
}
