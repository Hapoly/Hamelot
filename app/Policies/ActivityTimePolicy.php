<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\ActivityTime;
use App\Models\Unit;

class ActivityTimePolicy
{
    use HandlesAuthorization;

    public function modify(User $user, ActivityTime $activity_time){
        if($user->isAdmin())
            return true;
        if($user->isManager()){
            return $activity_time->unit_user->whereHas('unit', function($query) use ($user){
                return $query->whereHas('managers', function($query) use ($user){
                    return $query->where('users.id', $user->id);
                });
            })->first() != null;
        }if($user->isSecretary()){
            return $activity_time->unit_user->whereHas('unit', function($query) use ($user){
                return $query->whereHas('secretaries', function($query) use ($user){
                    return $query->where('users.id', $user->id);
                });
            })->first() != null;
        }else
            return $activity_time->unit_user->user_id == $user->id;
    }

    public function destroy(User $user, ActivityTime $activity_time){
        if($user->isAdmin())
            return true;
        if($user->isManager()){
            return $activity_time->unit_user->whereHas('unit', function($query) use ($user){
                return $query->whereHas('managers', function($query) use ($user){
                    return $query->where('users.id', $user->id);
                });
            })->first() != null;
        }if($user->isSecretary()){
            return $activity_time->unit_user->whereHas('unit', function($query) use ($user){
                return $query->whereHas('secretaries', function($query) use ($user){
                    return $query->where('users.id', $user->id);
                });
            })->first() != null;
        }else
            return $activity_time->unit_user->user_id == $user->id;
    }
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
