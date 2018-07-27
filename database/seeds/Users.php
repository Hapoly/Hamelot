<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'      => 'admin',
            'password'      => bcrypt('admin'),
            'group_code'    => 1,
            'first_name'    => 'علیرضا',
            'last_name'     => 'دربندی',
        ]);
    }
}
