<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BasicTest extends DuskTestCase{
    public function testHomePageLoaded(){
        $this->browse(function (Browser $browser) {
            $browser->visit(route('welcome'))
                    ->assertSee('جستجو');
        });
    }
    public function testSearchOpeation(){
        $this->browse(function(Browser $browser) {
            $browser->visit(route('welcome'))
                    ->type('term', '')
                    ->click('.search-btns')
                    ->assertSee('جستجو');
        });
    }
    public function testAuthPages(){
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                    ->assertSee('ورود');
        });
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('ثبت نام');
        });
    }
    public function testLoginOperation(){
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                    ->type('username', env('TEST_ADMIN_USERNAME'))
                    ->type('password', env('TEST_ADMIN_PASSWORD'))
                    ->click('#login')
                    ->assertPathIs('/home');
        });
    }
}
