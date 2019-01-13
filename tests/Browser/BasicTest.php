<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BasicTest extends DuskTestCase {
  /**
   * @group basic
   */
  public function testHomePageLoaded() {
    $this->browse(function (Browser $browser) {
      $browser->visit(route('welcome'))
        ->assertSee('نوبت دهی');
    });
  }
  /**
   * @group basic
   */
  public function testSearchOpeation() {
    $this->browse(function (Browser $browser) {
      $browser->visit(route('welcome'))
        ->type('term', '')
        ->click('.search-btns')
        ->assertSee('جستجو');
    });
  }
}
