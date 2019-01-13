<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NormalTest extends DuskTestCase {
  /**
   * @group auth
   */
  public function testLoginOperation() {
    $this->browse(function (Browser $browser) {
      $browser->visit(route('login', ['group' => 5]))
        ->assertSee('ارسال');
      $browser->type('phone', '09214756475')
        ->click('.btn-primary')
        ->assertSee('شما با شماره');
    });
  }

}
