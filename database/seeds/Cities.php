<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\City;
use App\Models\Province;
class Cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = Province::all();
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'رشت',
            'lon'           => 34.32234,
            'lat'           => 42.234234,
        ]);
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'انزلی',
            'lon'           => 35.32234,
            'lat'           => 41.23423,
        ]);
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'لاهیجان',
            'lon'           => 30.23423,
            'lat'           => 42.234234,
        ]);
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'صومعه‌سرا',
            'lon'           => 31.32234,
            'lat'           => 44.23423,
        ]);
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'آستارا',
            'lon'           => 32.45643,
            'lat'           => 43.36522,
        ]);
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'رودسر',
            'lon'           => 33.246324,
            'lat'           => 40.234234,
        ]);
        City::create([
            'province_id'   => $provinces[1]->id,
            'title'         => 'رودبار',
            'lon'           => 34.32234,
            'lat'           => 44.2365253,
        ]);
    }
}
