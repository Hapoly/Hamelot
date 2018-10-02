<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Province;

class Provinces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'title' => 'تهران',
        ]);
        Province::create([
            'title' => 'گیلان',
        ]);
        Province::create([
            'title' => 'مازندران',
        ]);
        Province::create([
            'title' => 'قزوین',
        ]);
        Province::create([
            'title' => 'اردبیل',
        ]);
        Province::create([
            'title' => 'گلستان',
        ]);
        Province::create([
            'title' => 'زنجان',
        ]);
    }
}
