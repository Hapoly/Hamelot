<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'            => 1,
            'username'      => 'admin',
            'password'      => bcrypt('admin'),
            'group_code'    => 1,
            'first_name'    => 'علیرضا',
            'last_name'     => 'دربندی',
        ]);
        /**
         * creating two managers
         */
        DB::table('users')->insert([
            'id'            => 2,
            'username'      => 'manager1',
            'password'      => bcrypt('manager1'),
            'group_code'    => 2,
            'first_name'    => 'گروس',
            'last_name'     => 'عبدلملکیان',
        ]);
        DB::table('users')->insert([
            'id'            => 3,
            'username'      => 'manager2',
            'password'      => bcrypt('manager2'),
            'group_code'    => 2,
            'first_name'    => 'فاطیما',
            'last_name'     => 'عزیزی',
        ]);
        /**
         * creating two doctors
         */
        DB::table('users')->insert([
            'id'            => 4,
            'username'      => 'doctor1',
            'password'      => bcrypt('doctor1'),
            'group_code'    => 3,
            'first_name'    => 'سامان',
            'last_name'     => 'ذبیحی',
        ]);
        DB::table('doctors')->insert([
            'user_id'       => 4,
            'degree'        => 2,
            'field'         => 2,
            'profile'       => 'NuLL',
            'gender'        => 19,
        ]);

        DB::table('users')->insert([
            'id'            => 5,
            'username'      => 'doctor2',
            'password'      => bcrypt('doctor2'),
            'group_code'    => 3,
            'first_name'    => 'فلاح',
            'last_name'     => 'ابوزاده',
        ]);
        DB::table('doctors')->insert([
            'user_id'       => 5,
            'degree'        => 2,
            'field'         => 2,
            'profile'       => 'NuLL',
            'gender'        => 19,
        ]);

        /**
         * creating two nurses
         */
        DB::table('users')->insert([
            'id'            => 6,
            'username'      => 'nurse1',
            'password'      => bcrypt('nurse1'),
            'group_code'    => 4,
            'first_name'    => 'عزیز',
            'last_name'     => 'صمیری',
        ]);
        DB::table('nurses')->insert([
            'user_id'       => 6,
            'degree'        => 2,
            'field'         => 2,
            'profile'       => 'NuLL',
            'gender'        => 19,
        ]);

        DB::table('users')->insert([
            'id'            => 7,
            'username'      => 'nurse2',
            'password'      => bcrypt('nurse2'),
            'group_code'    => 4,
            'first_name'    => 'شادی',
            'last_name'     => 'علوی',
        ]);
        DB::table('nurses')->insert([
            'user_id'       => 7,
            'degree'        => 2,
            'field'         => 2,
            'profile'       => 'NuLL',
            'gender'        => 20,
        ]);

        /**
         * creating patients
         */
        DB::table('users')->insert([
            'id'            => 8,
            'username'      => 'patient1',
            'password'      => bcrypt('patient1'),
            'group_code'    => 5,
            'first_name'    => 'فاطمه',
            'last_name'     => 'آقاجان پور',
        ]);
        DB::table('patients')->insert([
            'gender'        => 20,
            'id_number'     => '324234252343',
            'user_id'       => 8,
            'profile'       => 'NuLL',
            'birth_date'    => 1111232334
        ]);

        DB::table('users')->insert([
            'id'            => 9,
            'username'      => 'patient2',
            'password'      => bcrypt('patient2'),
            'group_code'    => 5,
            'first_name'    => 'حمید',
            'last_name'     => 'مصطفایی',
        ]);
        DB::table('patients')->insert([
            'gender'        => 19,
            'id_number'     => '43623523235',
            'user_id'       => 9,
            'profile'       => 'NuLL',
            'birth_date'    => 1190232334
        ]);

        DB::table('users')->insert([
            'id'            => 10,
            'username'      => 'patient3',
            'password'      => bcrypt('patient3'),
            'group_code'    => 5,
            'first_name'    => 'رضا',
            'last_name'     => 'هزاره‌زاده',
        ]);
        DB::table('patients')->insert([
            'gender'        => 19,
            'id_number'     => '23452352342',
            'user_id'       => 10,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);

        DB::table('users')->insert([
            'id'            => 11,
            'username'      => 'patient6',
            'password'      => bcrypt('patient6'),
            'group_code'    => 5,
            'first_name'    => 'شایان',
            'last_name'     => 'خالق پرست',
        ]);
        DB::table('patients')->insert([
            'gender'        => 19,
            'id_number'     => '23452352342',
            'user_id'       => 11,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);

        DB::table('users')->insert([
            'id'            => 12,
            'username'      => 'patient5',
            'password'      => bcrypt('patient5'),
            'group_code'    => 5,
            'first_name'    => 'ساناز',
            'last_name'     => 'هادی‌پور',
        ]);
        DB::table('patients')->insert([
            'gender'        => 20,
            'id_number'     => '23452352342',
            'user_id'       => 12,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);

        DB::table('users')->insert([
            'id'            => 13,
            'username'      => 'patient4',
            'password'      => bcrypt('patient4'),
            'group_code'    => 5,
            'first_name'    => 'اشکان',
            'last_name'     => 'خطیبی',
        ]);
        DB::table('patients')->insert([
            'gender'        => 19,
            'id_number'     => '23452352342',
            'user_id'       => 13,
            'profile'       => 'NuLL',
            'birth_date'    => 1142232334
        ]);
    }
}
