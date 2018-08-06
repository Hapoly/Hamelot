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
        $this->call(Consts::class);
        $this->call(Permissions::class);
        $this->call(Departments::class);
        $this->call(Hospitals::class);
        $this->call(HospitalUsers::class);
        $this->call(DepartmentUsers::class);
    }
}
