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
            'title' => 'اردبيل',
        ]);
        Province::create([
            'title' => 'اصفهان',
        ]);
        Province::create([
            'title' => 'البرز',
        ]);
        Province::create([
            'title' => 'ايلام',
        ]);
        Province::create([
            'title' => 'آذربايجان شرقي',
        ]);
        Province::create([
            'title' => 'آذربايجان غربي',
        ]);
        Province::create([
            'title' => 'بوشهر',
        ]);
        Province::create([
            'title' => 'تهران',
        ]);
        Province::create([
            'title' => 'چهارمحال وبختياري',
        ]);
        Province::create([
            'title' => 'خراسان جنوبي',
        ]);
        Province::create([
            'title' => 'خراسان رضوي',
        ]);
        Province::create([
            'title' => 'خراسان شمالي',
        ]);
        Province::create([
            'title' => 'خوزستان',
        ]);
        Province::create([
            'title' => 'زنجان',
        ]);
        Province::create([
            'title' => 'سمنان',
        ]);
        Province::create([
            'title' => 'سيستان وبلوچستان',
        ]);
        Province::create([
            'title' => 'فارس',
        ]);
        Province::create([
            'title' => 'قزوين',
        ]);
        Province::create([
            'title' => 'قم',
        ]);
        Province::create([
            'title' => 'كردستان',
        ]);
        Province::create([
            'title' => 'كرمان',
        ]);
        Province::create([
            'title' => 'كرمانشاه',
        ]);
        Province::create([
            'title' => 'كهگيلويه وبويراحمد',
        ]);
        Province::create([
            'title' => 'گلستان',
        ]);
        Province::create([
            'title' => 'گيلان',
        ]);
        Province::create([
            'title' => 'لرستان',
        ]);
        Province::create([
            'title' => 'مازندران',
        ]);
        Province::create([
            'title' => 'مركزي',
        ]);
        Province::create([
            'title' => 'هرمزگان',
        ]);
        Province::create([
            'title' => 'همدان',
        ]);
        Province::create([
            'title' => 'يزد',
        ]);
    }
}
