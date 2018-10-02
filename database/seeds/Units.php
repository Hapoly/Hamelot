<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\City;

class Units extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = City::all();
        Unit::create([
            'title'         => 'راضی',
            'address'       => 'چهارراه عباسنیا - روبروی صادرات',
            'phone'         => '34234234',
            'mobile'        => '252342',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'group_code'    => Unit::HOSPITAL,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
        Unit::create([
            'title'         => 'پورسینا',
            'address'       => 'خیابان پرستا - جنب سازمان تامین اجتماعی',
            'phone'         => '234523525',
            'mobile'        => '2345625',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'group_code'    => Unit::HOSPITAL,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
        Unit::create([
            'title'         => 'خون',
            'address'       => 'طبقه اول',
            'phone'         => '345435243',
            'mobile'        => '34634525',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => 1,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);

        Unit::create([
            'title'         => 'اورژانس',
            'address'       => 'طبقه دوم',
            'phone'         => '435634523',
            'mobile'        => '3463452345',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => 1,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
        Unit::create([
            'title'         => 'عمل جراحی',
            'address'       => 'ساختمان صدر',
            'phone'         => '23523523',
            'mobile'        => '235463',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => 2,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);

        Unit::create([
            'title'         => 'زنان زایمان',
            'address'       => 'راهروی شمالی',
            'phone'         => '2342454',
            'mobile'        => '02934823',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => 2,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
    }
}
