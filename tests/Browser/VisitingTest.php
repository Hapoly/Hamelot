<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class VisitingTest extends DuskTestCase{
    /**
     * @group visit
     * @group create
     */
    public function testCreateVisit(){
        $this->browse(function (Browser $browser) {
            $user = User::where('username', 'patient1')->first();
            $browser->loginAs($user)
                    ->visit(route('show.user', ['slug' => 'doctor1']))
                    ->click('#app > main > div > div > div > div > div:nth-child(2) > div > table > tbody > tr > td:nth-child(2) > div > a:nth-child(12)')
                    ->value('#description', 'مشکل درد گوش')
                    ->select('#address_id')
                    ->click('#submit')
                    ->click('#ok_pay')
                    ->assertSee('پایان')
                    ->assertSee('لغو');
        });
    }
}
