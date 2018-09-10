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
            'unit_id'           => 1,
            'user_id'           => 4,
            'status'            => 2,
            'type'              => 2,
        ]);
        UnitUser::create([
            'unit_id'       => 1,
            'user_id'       => 2,
            'type'          => 3,
            'permission'    => 2,
            'status'        => 2,
        ]);
        UnitUser::create([
            'unit_id'       => 1,
            'user_id'       => 3,
            'type'          => 3,
            'permission'    => 2,
            'status'        => 2,
        ]);
        UnitUser::create([
            'unit_id'       => 2,
            'user_id'       => 3,
            'type'          => 3,
            'permission'    => 2,
            'status'        => 2,
        ]);
        // UnitUser::create([
        //     'unit_id'     => 2,
        //     'user_id'           => 5
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 3,
        //     'user_id'           => 6
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 4,
        //     'user_id'           => 7
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 5,
        //     'user_id'           => 8
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 6,
        //     'user_id'           => 9
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 7,
        //     'user_id'           => 10
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 8,
        //     'user_id'           => 11
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 1,
        //     'user_id'           => 6
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 2,
        //     'user_id'           => 8
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 3,
        //     'user_id'           => 11
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 4,
        //     'user_id'           => 10
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 5,
        //     'user_id'           => 4
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 6,
        //     'user_id'           => 5
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 7,
        //     'user_id'           => 6
        // ]);
        // UnitUser::create([
        //     'unit_id'     => 8,
        //     'user_id'           => 7
        // ]);
    }
}
