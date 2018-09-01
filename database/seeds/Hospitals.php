<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Hospitals extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            'title'         => 'راضی',
            'address'       => 'چهارراه عباسنیا - روبروی صادرات',
            'phone'         => '23892398',
            'mobile'        => '0923427384',
            'image'         => 'NuLL',
        ]);
        DB::table('hospitals')->insert([
            'title'         => 'پورسینا',
            'address'       => 'خیابان پرستا - جنب سازمان تامین اجتماعی',
            'phone'         => '2342454',
            'mobile'        => '02934823',
            'image'         => 'NuLL',
        ]);
    }
}
