<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\ReportTemplate;
use App\Models\User;

class ReportTemplatePolicy {
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct() {
  }

  public function create(User $user, ReportTemplate $reportTemplate){
    return $user->isAdmin();
  }
  public function edit(User $user, ReportTemplate $reportTemplate){
    return $user->isAdmin();
  }
  public function destroy(User $user, ReportTemplate $reportTemplate){
    return $user->isAdmin();
  }
  public function show(User $user, ReportTemplate $reportTemplate){
    return $user->isAdmin();
  }
}
