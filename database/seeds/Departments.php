<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Departments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'title'         => 'خون',
            'description'   => 'طبقه سوم',
            'hospital_id'   => 1
        ]);
        DB::table('departments')->insert([
            'title'         => 'کودکان',
            'description'   => 'طبقه دوم',
            'hospital_id'   => 1
        ]);
        DB::table('departments')->insert([
            'title'         => 'زنان زایمان',
            'description'   => 'طبقه اول',
            'hospital_id'   => 1
        ]);
        DB::table('departments')->insert([
            'title'         => 'سوانح سوختگی',
            'description'   => 'ساختمان سوانح',
            'hospital_id'   => 1
        ]);
        DB::table('departments')->insert([
            'title'         => 'دیالیز',
            'description'   => 'طبقه سوم',
            'hospital_id'   => 2
        ]);
        DB::table('departments')->insert([
            'title'         => 'اتاق عمل',
            'description'   => 'طبقه دوم',
            'hospital_id'   => 2
        ]);
        DB::table('departments')->insert([
            'title'         => 'قلب',
            'description'   => 'طبقه اول',
            'hospital_id'   => 2
        ]);
        DB::table('departments')->insert([
            'title'         => 'اورژانس',
            'description'   => 'ساختمان سوانح',
            'hospital_id'   => 2
        ]);
    }
}
