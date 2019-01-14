<?php

namespace App\Policies;

use App\Models\Bid;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy {
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct() {
  }

  public function modify(User $user, Bid $bid) {
    return $user->isAdmin();
  }
  public function destroy(User $user, Bid $bid) {
    return $user->isAdmin();
  }
  public function see_providers(User $user, Bid $bid) {
    return $user->isPatient() || $user->isAdmin();
  }
  public function see_patient(User $user, Bid $bid) {
    return $user->isDoctor() || $user->isNurse() || $user->isManager();
  }
  public function operate(User $user, Bid $bid) {
    return !$bid->finished && !$bid->permission_to_operate_bid;
  }
  public function cancel_by_patient(User $user, Bid $bid) {
    if (!$user->isPatient()) {
      return false;
    }

    return $bid->demand->patient_id == $user->id;
  }
  public function cancel_by_provider(User $user, Bid $bid) {
    if ($user->isAdmin()) {
      return true;
    }
    if ($user->isNurse() || $user->isDoctor()) {
      return ($bid->demand->user_id == $user->id);
    }
    if ($user->isSecretary()) {
      return ($bid->demand->unit->secretaries()->where($user->id)->first()) != null;
    }
    if ($user->isManager()) {
      return ($bid->demand->unit->managers()->where($user->id)->first()) != null;
    }
    return false;
  }
  public function finish_by_provider(User $user, Bid $bid) {
    if ($user->isAdmin()) {
      return true;
    }
    if ($user->isNurse() || $user->isDoctor()) {
      return ($bid->demand->user_id == $user->id);
    }
    if ($user->isSecretary()) {
      return ($bid->demand->unit->secretaries()->where($user->id)->first()) != null;
    }
    if ($user->isManager()) {
      return ($bid->demand->unit->managers()->where($user->id)->first()) != null;
    }
    return false;
  }
}
