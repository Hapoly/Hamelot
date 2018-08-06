<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hopital_user')->insert([
            'hospital_id'   => 1,
            'user_id'       => 2
        ]);
        DB::table('hopital_user')->insert([
            'hospital_id'   => 1,
            'user_id'       => 3
        ]);
        DB::table('hopital_user')->insert([
            'hospital_id'   => 2,
            'user_id'       => 3
        ]);
    }
}
