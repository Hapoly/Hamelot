<?php

use Illuminate\Database\Seeder;
use App\Models\Bid;
use App\Models\Unit;
use App\User;
use App\Models\Demand;
class Bids extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = Unit::first();
        $user = User::where('username', 'doctor1')->first();
        $demand = Demand::first();
        Bid::create([
            'demand_id'     => $demand->id,
            'date'          => 1538368702,
            'unit_id'       => $unit->id,
            'user_id'       => $user->id,
            'description'   => 'تخفیف ویژه',
            'price'         => 20000,
            'deposit'       => 3000,
            'unit_accepted' => 1,
            'user_accepted' => 1,
        ]);
    }
}
