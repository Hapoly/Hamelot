<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\ConstValue;
use App\Models\UserConst;
use App\Models\City;
use App\Models\Unit;
use App\Models\UnitUser;
use App\Models\ActivityTime;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $first_names = ['علیرضا', 'سعید', 'رضا', 'مهدی', 'شایان', 'امین', 'امیر' ,'ژاله' ,'ارشیا' ,'آرین' ,'سجاد'];
        $last_names = ['رضایی', 'عباسقلی زاده', 'امیری', 'نصر', 'احمدی', 'روشن', 'ضمیری', 'سعیدزاده', 'تهرانی', 'آسمانی', 'پاکنژاد'];
        $address_parts = ['درویشیان', 'لاله زاد', 'خیابان ناجی', 'ساختمان شهری', 'کوچه سلامت', 'کوچه عبیدی', 'خیابان رزاقی', 'خیابان آرژانتین', 'خیابان شریعتی', 'خیابان امام'];
        $cities = City::all();
        $fields = ConstValue::where('type', ConstValue::DOCTOR_FIELDS)->get();
        /* admins */
        User::create([
            'phone'         => '09391111111',
            'first_name'    => $first_names[rand(0, sizeof($first_names)-1)],
            'last_name'     => $last_names[rand(0, sizeof($last_names)-1)],
            'group_code'    => User::G_ADMIN,
        ]);
        /* managers */
        User::create([
            'phone'         => '09381111111',
            'first_name'    => $first_names[rand(0, sizeof($first_names)-1)],
            'last_name'     => $last_names[rand(0, sizeof($last_names)-1)],
            'group_code'    => User::G_MANAGER,
        ]);
        /* secretaries */
        $secretary = User::create([
            'phone'         => '09112222222',
            'first_name'    => $first_names[rand(0, sizeof($first_names)-1)],
            'last_name'     => $last_names[rand(0, sizeof($last_names)-1)],
            'group_code'    => User::G_SECRETARY,
        ]);
        /* doctors */
        for($j=0; $j<25; $j++){
            $user = User::create([
                'phone'         => '0921' . rand(1000000, 9999999),
                'first_name'    => $first_names[rand(0, sizeof($first_names)-1)],
                'last_name'     => $last_names[rand(0, sizeof($last_names)-1)],
                'group_code'    => User::G_DOCTOR,
            ]);
            $id = $user->id;
            Doctor::create([
                'msc'           => rand(100000, 999999),
                'start_year'    => rand(1380, 1392),
                'gender'        => 1,
                'profile'       => '/users/' . rand(1, 17) . '.jpg',
                'user_id'       => $id,
            ]);
            for($i=0; $i<3; $i++){
                UserConst::create([
                    'user_id'   => $id,
                    'const_id'  => $fields[rand(0, sizeof($fields)-1)]->id
                ]);
            }

            $address = '';
            for($i=0; $i<3; $i++)
                $address .= $address_parts[rand(0, sizeof($address_parts)-1)];
            $city = $cities[rand(0, sizeof($cities)-1)];
            $unit = Unit::create([
                'title'         => $user->full_name,
                'address'       => $address,
                'city_id'       => $city->id,
                'lon'           => $city->lon,
                'lat'           => $city->lat,
                'phone'         => '01333' . rand(111111, 999999),
                'mobile'        => '09112222222',
                'group_code'    => Unit::CLINIC,
                'slug'          => rand(0, 999999),
                'type'          => Unit::ACTUAL,
            ]);

            UnitUser::create([
                'unit_id'       => $unit->id,
                'user_id'       => $id,
                'permission'    => UnitUser::MANAGER,
                'status'        => UnitUser::ACCEPTED,
            ]);
            $unit_user = UnitUser::create([
                'unit_id'       => $unit->id,
                'user_id'       => $id,
                'permission'    => UnitUser::MEMBER,
                'status'        => UnitUser::ACCEPTED,
            ]);
            UnitUser::create([
                'unit_id'       => $unit->id,
                'user_id'       => $secretary->id,
                'permission'    => UnitUser::SECRETARY,
                'status'        => UnitUser::ACCEPTED,
            ]);

            for($i=0; $i<4; $i++){
                $start_time = rand(32, 70);
                $finis_time = rand($start_time, 90);
                ActivityTime::create([
                    'unit_user_id'          => $unit_user->id,
                    'day_of_week'           => rand(1, 7),
                    'auto_fill'             => 1,
                    'start_time'            => $start_time * 15 * 60,
                    'finish_time'           => $finis_time * 15 * 60,
                    'just_in_unit_visit'    => ActivityTime::IN_UNIT,
                    'default_price'         => rand(10, 25) * 1000,
                    'default_deposit'       => 0,
                    'default_demand_time'   => 0,
                    'demand_limit'          => 0,
                    'type'                  => ActivityTime::VISIT,
                ]);
            }
        }
    }
}
