<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UnitUser;
use App\User;
use App\Models\Unit;

class UnitUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = User::where('group_code', User::G_DOCTOR)->orWhere('group_code', User::G_NURSE)->get();
        $managers = User::where('group_code', User::G_MANAGER)->get();
        $units = Unit::all();
        for($i=0; $i<5; $i++){
            UnitUser::create([
                'unit_id'       => $units[intval(rand() % sizeof($units))]->id,
                'user_id'       => $members[intval(rand() % sizeof($members))]->id,
                'status'        => UnitUser::ACCEPTED,
                'permission'    => UnitUser::MEMBER,
            ]);
        }
        for($i=0; $i<3; $i++){
            UnitUser::create([
                'unit_id'       => $units[intval(rand() % sizeof($units))]->id,
                'user_id'       => $managers[intval(rand() % sizeof($managers))]->id,
                'status'        => UnitUser::ACCEPTED,
                'permission'    => UnitUser::MANAGER,
            ]);
        }
    }
}
