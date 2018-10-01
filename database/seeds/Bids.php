<?php

use Illuminate\Database\Seeder;
use App\Models\Bid;
class Bids extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bid::create([
            'demand_id'     => 1,
            'date'          => 1538368702,
            'unit_id'       => 1,
            'user_id'       => 4,
            'description'   => 'تخفیف ویژه',
            'price'         => 20000,
            'deposit'       => 3000,
        ]);
    }
}
