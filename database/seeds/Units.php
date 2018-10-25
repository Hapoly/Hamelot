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
        $u1 = Unit::create([
            'title'         => 'راضی',
            'slug'          => 'razi',
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
        $u2 = Unit::create([
            'title'         => 'پورسینا',
            'slug'          => 'pursina',
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
            'slug'          => 'khoon',
            'address'       => 'طبقه اول',
            'phone'         => '345435243',
            'mobile'        => '34634525',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => $u1->id,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);

        Unit::create([
            'title'         => 'اورژانس',
            'slug'          => 'urjans',
            'address'       => 'طبقه دوم',
            'phone'         => '435634523',
            'mobile'        => '3463452345',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => $u1->id,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
        Unit::create([
            'title'         => 'عمل جراحی',
            'slug'          => 'amal-jarahi',
            'address'       => 'ساختمان صدر',
            'phone'         => '23523523',
            'mobile'        => '235463',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => $u2->id,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);

        Unit::create([
            'title'         => 'زنان زایمان',
            'slug'          => 'zanan',
            'address'       => 'راهروی شمالی',
            'phone'         => '2342454',
            'mobile'        => '02934823',
            'image'         => 'NuLL',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'parent_id'     => $u2->id,
            'group_code'    => Unit::DEPARTMENT,
            'public'        => Unit::T_PUBLIC,
            'type'          => Unit::ACTUAL,
            'lat'           => 32.43234,
            'lon'           => 45.435234
        ]);
    }
}
