<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    'App\Model' => 'App\Policies\ModelPolicy',
    'App\Models\Unit' => 'App\Policies\UnitPolicy',
    'App\Models\ActivityTime' => 'App\Policies\ActivityTimePolicy',
    'App\User' => 'App\Policies\UserPolicy',
    'App\Models\ReportTemplate' => 'App\Policies\ReportTemplatePolicy',
    'App\Models\Bid' => 'App\Policies\BidPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot() {
    $this->registerPolicies();

    Passport::routes();
  }
}
