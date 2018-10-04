<?php

use Illuminate\Database\Seeder;

use App\Models\Demand;
use App\User;

class Demands extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('username', 'patient1')->first();
        Demand::create([
            'description'   => 'کشیدن بخیه چشم',
            'patient_id'    => $user->id,
            'address_id'    => $user->addresses()->first()->id,
            'unit_id'       => 0,
            'user_id'       => 0,
            'asap'          => 1,
            'start_time'    => 0,
            'end_time'      => 0,
        ]);

        Demand::create([
            'description'   => 'تعویض پانسمان چشم',
            'patient_id'    => $user->id,
            'address_id'    => 0,
            'unit_id'       => 0,
            'user_id'       => 0,
            'asap'          => 1,
            'start_time'    => 0,
            'end_time'      => 0,
        ]);
    }
}
