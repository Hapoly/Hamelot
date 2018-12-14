<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\ConstValue;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'phone'         => '09216720496',
            'group_code'    => 1,
            'first_name'    => 'علیرضا',
            'last_name'     => 'دربندی',
        ]);
        /**
         * creating two managers
         */
        User::create([
            'phone'         => '09214857487',
            'group_code'    => 2,
            'first_name'    => 'گروس',
            'last_name'     => 'عبدلملکیان',
        ]);
        User::create([
            'phone'         => '+989XXXXXXXX3',
            'group_code'    => 2,
            'first_name'    => 'فاطیما',
            'last_name'     => 'عزیزی',
        ]);
        /**
         * creating two doctors
         */
        $d1 = User::create([
            'phone'         => '09369198095',
            'group_code'    => 3,
            'first_name'    => 'سامان',
            'last_name'     => 'ذبیحی',
        ]);
        Doctor::create([
            'user_id'       => $d1->id,
            'profile'       => 'NuLL',
            'gender'        => 1,
            'start_year'    => 1380,
        ]);

        $d2 = User::create([
            'phone'         => '09355849587',
            'group_code'    => 3,
            'first_name'    => 'فلاح',
            'last_name'     => 'ابوزاده',
        ]);
        Doctor::create([
            'user_id'       => $d2->id,
            'profile'       => 'NuLL',
            'gender'        => 1,
            'start_year'    => 1380,
        ]);

        /**
         * creating two nurses
         */
        $n0 = User::create([
            'phone'         => '09385748574',
            'group_code'    => 4,
            'first_name'    => 'عزیز',
            'last_name'     => 'صمیری',
        ]);
        Nurse::create([
            'user_id'       => $n0->id,
            'profile'       => 'NuLL',
            'gender'        => 1,
        ]);

        $n1 = User::create([
            'phone'         => '09113847584',
            'group_code'    => 4,
            'first_name'    => 'شادی',
            'last_name'     => 'علوی',
        ]);
        Nurse::create([
            'user_id'       => $n1->id,
            'profile'       => 'NuLL',
            'gender'        => 2,
        ]);

        /**
         * creating patients
         */
        $p0 = User::create([
            'phone'         => '09216720495',
            'group_code'    => 5,
            'first_name'    => 'فاطمه',
            'last_name'     => 'آقاجان پور',
        ]);
        Patient::create([
            'gender'        => 2,
            'id_number'     => '324234252343',
            'user_id'       => $p0->id,
            'profile'       => 'NuLL',
            'birth_date'    => 1111232334
        ]);

        $p1 = User::create([
            'phone'         => '09113857487',
            'group_code'    => 5,
            'first_name'    => 'حمید',
            'last_name'     => 'مصطفایی',
        ]);
        Patient::create([
            'gender'        => 1,
            'id_number'     => '43623523235',
            'user_id'       => $p1->id,
            'profile'       => 'NuLL',
            'birth_date'    => 1190232334
        ]);

        $p2 = User::create([
            'phone'         => '09123847384',
            'group_code'    => 5,
            'first_name'    => 'رضا',
            'last_name'     => 'هزاره‌زاده',
        ]);
        Patient::create([
            'gender'        => 1,
            'id_number'     => '23452352342',
            'user_id'       => $p2->id,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);

        $p3 = User::create([
            'phone'         => '09218473847',
            'group_code'    => 5,
            'first_name'    => 'شایان',
            'last_name'     => 'خالق پرست',
        ]);
        Patient::create([
            'gender'        => 1,
            'id_number'     => '23452352342',
            'user_id'       => $p3->id,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);

        $p4 = User::create([
            'phone'         => '09148574857',
            'group_code'    => 5,
            'first_name'    => 'ساناز',
            'last_name'     => 'هادی‌پور',
        ]);
        Patient::create([
            'gender'        => 2,
            'id_number'     => '23452352342',
            'user_id'       => $p4->id,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);

        $p5 = User::create([
            'phone'         => '09114857487',
            'group_code'    => 5,
            'first_name'    => 'اشکان',
            'last_name'     => 'خطیبی',
        ]);
        Patient::create([
            'gender'        => 1,
            'id_number'     => '23452352342',
            'user_id'       => $p5->id,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);
    }
}
