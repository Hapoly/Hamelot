<?php

use Illuminate\Database\Seeder;

use App\Models\ActivityTime;
use App\User;
use App\Models\UnitUser;

class ActivityTimes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $unit_user = User::where('username', 'doctor1')->first()->units[0]->pivot->id;
        $unit_users = UnitUser::where('permission', UnitUser::MEMBER)->get();
        foreach($unit_users as $unit_user){
            $default_data = [
                'unit_user_id'          => $unit_user->id,
                'demand_limit'          => 0,
                'default_price'         => 25000,
                'default_deposit'       => 10000,
                'default_demand_time'   => 0,
                'auto_fill'             => 1,
            ];
            for($i=1; $i<=7; $i++){
                $default_data['day_of_week'] = $i;
                for($j=0; $j<10; $j++){
                    $default_data['start_time'] = 2*($j+1) * 36000;
                    $default_data['finish_time'] = 2*($j+2) * 36000;
                    ActivityTime::create($default_data);
                }
            }
        }
    }
}
