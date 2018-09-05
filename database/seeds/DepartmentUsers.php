<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department_user')->insert([
            'department_id'     => 1,
            'user_id'           => 4,
            'status'            => 2,
            'type'              => 2,
        ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 2,
        //     'user_id'           => 5
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 3,
        //     'user_id'           => 6
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 4,
        //     'user_id'           => 7
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 5,
        //     'user_id'           => 8
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 6,
        //     'user_id'           => 9
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 7,
        //     'user_id'           => 10
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 8,
        //     'user_id'           => 11
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 1,
        //     'user_id'           => 6
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 2,
        //     'user_id'           => 8
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 3,
        //     'user_id'           => 11
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 4,
        //     'user_id'           => 10
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 5,
        //     'user_id'           => 4
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 6,
        //     'user_id'           => 5
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 7,
        //     'user_id'           => 6
        // ]);
        // DB::table('department_user')->insert([
        //     'department_id'     => 8,
        //     'user_id'           => 7
        // ]);
    }
}
