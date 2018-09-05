<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Policlinics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policlinics')->insert([
            'title'     => 'امام رضا',
            'address'   => 'خیابان پرستار',
            'phone'     => '۰۱۳۳۲۸۹۳۲',
            'mobile'    => '۰۹۲۱۸۳۷۴۳',
            'city_id'   => 1,
            'lon'       => 34.94323,
            'lat'       => 43.23242,
        ]);
    }
}
