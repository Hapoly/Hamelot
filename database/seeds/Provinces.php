<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Provinces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            'title' => 'تهران',
            'id'    => 1,
        ]);
        DB::table('provinces')->insert([
            'title' => 'گیلان',
            'id'    => 2,
        ]);
        DB::table('provinces')->insert([
            'title' => 'مازندران',
            'id'    => 3,
        ]);
        DB::table('provinces')->insert([
            'title' => 'قزوین',
            'id'    => 4,
        ]);
        DB::table('provinces')->insert([
            'title' => 'اردبیل',
            'id'    => 5,
        ]);
        DB::table('provinces')->insert([
            'title' => 'گلستان',
            'id'    => 6,
        ]);
        DB::table('provinces')->insert([
            'title' => 'زنجان',
            'id'    => 7,
        ]);
    }
}
