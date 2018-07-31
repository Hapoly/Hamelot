<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'admin_user_create',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'admin_user_edit',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'admin_user_remove',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'admin_user_list',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'manager_user_create',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'manager_user_edit',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'manager_user_remove',
        ]);
        DB::table('permissions')->insert([
            'group_code'    => 1,
            'label'         => 'manager_user_list',
        ]);
    }
}
