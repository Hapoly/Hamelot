<?php

use Illuminate\Database\Seeder;

use App\Models\Address;
use App\Models\City;
use App\User;

class Addresses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = City::all();
        $users = User::where('group_code', User::G_PATIENT)->get();
        Address::create([
            'title'         => 'خانه مادر',
            'plain'         => 'خیابان لاله - کوچه شمیری - پلاک ۱۸',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۲۱۴۳۷۸۳۷۴',
        ]);
        Address::create([
            'title'         => 'خانه',
            'plain'         => 'خیابان احقی - خیابان صفا - ساختمان شریان - طبقه ۲',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۱۱۳۷۴۸۷۴۴',
        ]);
        Address::create([
            'title'         => 'خانه آقای نبوی',
            'plain'         => 'میدان جهاد - خیابان تختی - کوچه سلامی - پلاک ۳ - واحد ۱',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۱۲۷۸۳۷۴۸۷۴',
        ]);
        Address::create([
            'title'         => 'خانه عمو صادق',
            'plain'         => 'خیابان شریعتی - کوچه سمیعی - پلاک ۴ - واحد ۱۸',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۲۱۷۳۸۷۴۳۸۷',
        ]);
        Address::create([
            'title'         => 'مرکز بهزیستی ثامن',
            'plain'         => 'خیابان مطهری - خیابان نواب',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۱۳۳۳۴۷۷۸۴۷۷۵',
        ]);
        Address::create([
            'title'         => 'خانه سالمندان شراره',
            'plain'         => 'خیابان عظیمه زاده - کوچه عزیزی - ساختمان پاک',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۱۳۴۳۷۸۳۷۸۳۳۵',
        ]);
        Address::create([
            'title'         => 'خانه دایی',
            'plain'         => 'خیابان طالقانی - خیابان ترقبه - کوچه ساکت - کوچه بنفشه - پلاک ۲۰',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۱۳۴۷۸۵۷۳۴۷۸۳',
        ]);
        Address::create([
            'title'         => 'رستوران آبگیر',
            'plain'         => 'خیابان هوشیار - میدان فلسطین',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۱۱۷۴۵۸۴۳۸۴۳',
        ]);
        Address::create([
            'title'         => 'هواشناسی',
            'plain'         => 'خیابان معلم - خیابان وحدت',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۳۸۴۳۴۵۷۸۷۴۵',
        ]);
        Address::create([
            'title'         => 'خانه مادر',
            'plain'         => 'خیابان معلم - خیابان وحدت - کوچه نسیم - ساختمان سپاس - طبقه ۳',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۳۵۵۷۴۸۷۴۳۴',
        ]);
        Address::create([
            'title'         => 'زندایی',
            'plain'         => 'خیابان احسانی - کوچه شهید قلیپور - پلاک ۹',
            'city_id'       => $cities[intval(rand() % sizeof($cities))]->id,
            'lon'           => 34.3223400000,
            'lat'           => 42.2342340000,
            'user_id'       => $users[intval(rand() % sizeof($users))]->id,
            'phone'         => '۰۹۱۱۷۳۸۴۷۳۴',
        ]);
    }
}
