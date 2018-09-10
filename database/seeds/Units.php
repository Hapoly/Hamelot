<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;

class Units extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'title'         => 'راضی',
            'address'       => 'چهارراه عباسنیا - روبروی صادرات',
            'phone'         => '23892398',
            'mobile'        => '0923427384',
            'image'         => 'NuLL',
            'city_id'       => 2,
            'group_code'    => Unit::HOSPITAL,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
        Unit::create([
            'title'         => 'پورسینا',
            'address'       => 'خیابان پرستا - جنب سازمان تامین اجتماعی',
            'phone'         => '2342454',
            'mobile'        => '02934823',
            'image'         => 'NuLL',
            'city_id'       => 4,
            'group_code'    => Unit::HOSPITAL,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
    }
}
