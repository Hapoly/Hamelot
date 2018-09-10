<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UnitUser;

class UnitUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitUser::create([
            'unit_id'       => 1,
            'user_id'       => 2,
            'status'        => 2,
            'permission'    => UnitUser::MANAGER,
        ]);
        UnitUser::create([
            'unit_id'       => 2,
            'user_id'       => 3,
            'status'        => 2,
            'permission'    => UnitUser::MANAGER,
        ]);
    }
}
