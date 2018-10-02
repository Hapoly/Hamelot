<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'      => 'admin',
            'password'      => bcrypt('admin'),
            'group_code'    => 1,
            'first_name'    => 'علیرضا',
            'last_name'     => 'دربندی',
        ]);
        /**
         * creating two managers
         */
        User::create([
            'username'      => 'manager1',
            'password'      => bcrypt('manager1'),
            'group_code'    => 2,
            'first_name'    => 'گروس',
            'last_name'     => 'عبدلملکیان',
        ]);
        User::create([
            'username'      => 'manager2',
            'password'      => bcrypt('manager2'),
            'group_code'    => 2,
            'first_name'    => 'فاطیما',
            'last_name'     => 'عزیزی',
        ]);
        /**
         * creating two doctors
         */
        $d1 = User::create([
            'username'      => 'doctor1',
            'password'      => bcrypt('doctor1'),
            'group_code'    => 3,
            'first_name'    => 'سامان',
            'last_name'     => 'ذبیحی',
        ]);
        Doctor::create([
            'user_id'       => $d1->id,
            'degree_id'     => 2,
            'field_id'      => 2,
            'profile'       => 'NuLL',
            'gender'        => 1,
        ]);

        $d2 = User::create([
            'username'      => 'doctor2',
            'password'      => bcrypt('doctor2'),
            'group_code'    => 3,
            'first_name'    => 'فلاح',
            'last_name'     => 'ابوزاده',
        ]);
        Doctor::create([
            'user_id'       => $d1->id,
            'degree_id'     => 2,
            'field_id'      => 2,
            'profile'       => 'NuLL',
            'gender'        => 1,
        ]);

        /**
         * creating two nurses
         */
        $n0 = User::create([
            'username'      => 'nurse1',
            'password'      => bcrypt('nurse1'),
            'group_code'    => 4,
            'first_name'    => 'عزیز',
            'last_name'     => 'صمیری',
        ]);
        Nurse::create([
            'user_id'       => $n0->id,
            'degree_id'     => 2,
            'field_id'      => 2,
            'profile'       => 'NuLL',
            'gender'        => 1,
        ]);

        $n1 = User::create([
            'username'      => 'nurse2',
            'password'      => bcrypt('nurse2'),
            'group_code'    => 4,
            'first_name'    => 'شادی',
            'last_name'     => 'علوی',
        ]);
        Nurse::create([
            'user_id'       => $n1->id,
            'degree_id'     => 2,
            'field_id'      => 2,
            'profile'       => 'NuLL',
            'gender'        => 2,
        ]);

        /**
         * creating patients
         */
        $p0 = User::create([
            'username'      => 'patient1',
            'password'      => bcrypt('patient1'),
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
            'username'      => 'patient2',
            'password'      => bcrypt('patient2'),
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
            'username'      => 'patient3',
            'password'      => bcrypt('patient3'),
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
            'username'      => 'patient6',
            'password'      => bcrypt('patient6'),
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
            'username'      => 'patient5',
            'password'      => bcrypt('patient5'),
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
            'username'      => 'patient4',
            'password'      => bcrypt('patient4'),
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
