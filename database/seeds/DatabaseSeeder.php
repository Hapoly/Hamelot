<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(Cities::class);
        $this->call(Provinces::class);
        $this->call(Consts::class);
        $this->call(Units::class);
        $this->call(UnitUsers::class);
        $this->call(ReportTemplates::class);
        $this->call(Addresses::class);
        $this->call(Demands::class);
        $this->call(Bids::class);
    }
}
