<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;

use App\User;
use App\Models\Unit;
use App\Models\UnitUser;

class UnitPolicy{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function before(User $user){
    }
    public function update(User $user, Unit $unit){
        if($user->isAdmin())
            return true; 
        if($user->isSecretary())
            return $units->secretaries()->where('user.id', $user->id)->first() != null;
        return $unit->managers()->where('users.id', $user-> id)->first() != null;
    }
    
    public function destroy(User $user, Unit $unit){
        if($user->isAdmin())
            return true; 
        return $unit->managers()->where('users.id', $user->id)->first() != null;
    }

    public function create_demand(User $user, Unit $unit){
        return $user->isPatient();
    }

    public function join(User $user, Unit $unit){
        if($user->isAdmin())
            return true; 
        else if($user->isManager())
            return $unit->requests()->where('user_id', $user->id)->where('permission', UnitUser::MANAGER)->first() == null;
        else if($user->isSecretary())
            return $unit->requests()->where('user_id', $user->id)->where('permission', UnitUser::SECRETARY)->first() == null;
        else if($user->isDoctor() || $user->isNurse())
            return $unit->requests()->where('user_id', $user->id)->where('permission', UnitUser::MEMBER)->first() == null;
        else
            return false;
    }

    public function add_secretary(User $user, Unit $unit){
        if($user->isAdmin())
            return true;
        else
            return $unit->managers()->where('users.id', $user->id)->first() != null;
    }
    
    public function add_member(User $user, Unit $unit){
        if($user->isAdmin())
            return true;
        else
            return $unit->managers()->where('users.id', $user->id)->first() != null;
    }

    
    public function add_manager(User $user, Unit $unit){
        if($user->isAdmin())
            return true;
        else
            return $unit->managers()->where('users.id', $user->id)->first() != null;
    }

    public function see_managers(User $user, Unit $unit){
        if($user->isAdmin())
            return true;
        if($unit->managers()->where('users.id', $user->id)->first() != null)
            return true;
        if($unit->members()->where('users.id', $user->id)->first() != null)
            return true;
        if($unit->secretaries()->where('users.id', $user->id)->first() != null)
            return true;
        return false;
    }

    public function see_members(User $user, Unit $unit){
        return true;
    }

    public function see_secretaries(User $user, Unit $unit){
        if($user->isAdmin())
            return true;
        if($unit->managers()->where('users.id', $user->id)->first() != null)
            return true;
        if($unit->members()->where('users.id', $user->id)->first() != null)
            return true;
        if($unit->secretaries()->where('users.id', $user->id)->first() != null)
            return true;
        return false;
    }

    public function see_sub_units(User $user, Unit $unit){
        return true;
    }
    public function add_sub_unit(User $user, Unit $unit){
        if($user->isAdmin())
            return true;
        else
            return $unit->managers()->where('users.id', $user->id)->first() != null;
    }

    public function __construct(){
        //
    }
}
