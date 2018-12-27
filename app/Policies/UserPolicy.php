<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function read_info(User $user, User $target){
        if($user->isAdmin())
            return true;
        if($target->isAdmin())
            return false;
    }
    public function read_history(User $user, User $target){
        switch($user->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
            case User::G_SECRETARY:
                return false;
            case User::G_DOCTOR:
            case User::G_NURSE:
                return $target->whereHas('permissions', function($query) use ($user, $target){
                    return $query->where([
                            ['requester_id' => $user->id],
                            ['status'       => Permission::ACCEPTED]]);
                })->first() != null;
            case User::G_PATIENT:
                return $target->id == $user->id;
        }
        return false;
    }
    public function read_units(User $user, User $target){
        if($user->isAdmin())
            return true;
        else if($target->id == $user->id)
            return true;
        else if($user->isManager() || $user->isDoctor() || $user->isNurse())
            return ($target->units()->whereHas('managers', function($query) use ($user){
                return $query->where('users.id', $user->id);
            })->first()) != null;
        else if($user->isSecretary())
            return ($target->units()->whereHas('secretaries', function($query) use ($user){
                return $query->where('users.id', $user->id);
            })->first()) != null;
        
        return false;
    }
    public function write_info(User $user, User $target){
        if($user->isAdmin())
            return true;
        else if($target->id == $user->id)
            return true;
        else if($user->isManager() || $user->isDoctor() || $user->isNurse())
            return ($target->units()->whereHas('managers', function($query){
                return $query->where('users.id', $user->id);
            })->first()) != null;
        return false;
    }
    public function write_history(User $user, User $target){
        switch($user->group_code){
            case User::G_ADMIN:
                return true;
            case User::G_MANAGER:
                return false;
            case User::G_SECRETARY:
                return false;
            case User::G_DOCTOR:
            case User::G_NURSE:
                return $target->whereHas('permissions', function($query){
                    return $query->where([
                            ['requester_id' => $user->id],
                            ['status'       => Permission::ACCEPTED]]);
                })->first() != null;
            case User::G_PATIENT:
                return $target->id == $user->id;
        }
        return false;
    }
    public function write_units(User $user, User $target){
        return $user->isAdmin() || $user->isManager();
    }
    public function __construct()
    {
        //
    }
}
