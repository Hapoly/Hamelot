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
            'lon'           => 34.32234,
            'lat'           => 42.234234,
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'انزلی',
            'lon'           => 35.32234,
            'lat'           => 41.23423,
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'لاهیجان',
            'lon'           => 30.23423,
            'lat'           => 42.234234,
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'صومعه‌سرا',
            'lon'           => 31.32234,
            'lat'           => 44.23423,
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'آستارا',
            'lon'           => 32.45643,
            'lat'           => 43.36522,
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'رودسر',
            'lon'           => 33.246324,
            'lat'           => 40.234234,
        ]);
        DB::table('cities')->insert([
            'province_id'   => 2,
            'title'         => 'رودبار',
            'lon'           => 34.32234,
            'lat'           => 44.2365253,
        ]);
    }
}
