<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class AdminPanelTest extends DuskTestCase{
    public function testManagerCreate()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('username', env('test_manager1'))->delete();
            $browser->loginAs(User::where('username', env('TEST_ADMIN_USERNAME'))->first())
                    ->visit(route('panel.users.create.manager'))
                    ->value('#username', 'test_manager1')
                    ->value('#password', 'test_manager1')
                    ->value('#password_confirmation', 'test_manager1')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213265675')
                    ->click('#submit')
                    ->assertTitleContains('امیر');
            $user = User::where('username', env('test_manager1'))->delete();
        });
    }
    protected function captureFailuresFor($browsers) {
        parent::captureFailuresFor($browsers);
        foreach($browsers as $browser)
            $browser->resize(1920,1080)
                    ->screenshot('admin_panel_' . rand(0, 1000));
    }
}
