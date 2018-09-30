<?php

use Illuminate\Database\Seeder;

use App\Models\Demand;

class Demands extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Demand::create([
            'description'   => 'کشیدن بخیه چشم',
            'patient_id'    => 8,
            'address_id'    => 6,
            'unit_id'       => 0,
            'user_id'       => 0,
            'asap'          => 1,
            'start_time'    => 0,
            'end_time'      => 0,
        ]);

        Demand::create([
            'description'   => 'تعویض پانسمان چشم',
            'patient_id'    => 8,
            'address_id'    => 0,
            'unit_id'       => 0,
            'user_id'       => 0,
            'asap'          => 1,
            'start_time'    => 0,
            'end_time'      => 0,
        ]);
    }
}
