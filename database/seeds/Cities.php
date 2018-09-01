<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'رشت',
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'انزلی',
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'لاهیجان',
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'صومعه‌سرا',
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'آستارا',
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'رودسر',
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'رودبار',
        ]);
    }
}
