<?php

namespace Tests\Browser\Admin\Cruds\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ManagerTest extends DuskTestCase{
    /**
     * @group admin_permission
     * @group manager_crud
     * @group success
     * @group create
     * @group success
     */
    public function testManagerCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_manager1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.manager'))
                    ->waitFor('#username')
                    ->value('#username', 'test_manager1')
                    ->value('#password', 'test_manager1')
                    ->value('#password_confirmation', 'test_manager1')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertTitleContains('امیر');
        });
    }
    /**
     * @group admin_permission
     * @group manager_crud
     * @group edit
     * @group fail
     * @group username
     */
    public function testManagerEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    /**
     * @group admin_permission
     * @group manager_crud
     * @group edit
     * @group fail
     * @group phone
     */
    public function testManagerEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    /**
     * @group admin_permission
     * @group manager_crud
     * @group edit
     * @group success
     */
    public function testManagerEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    /**
     * @group admin_permission
     * @group manager_crud
     * @group remove
     * @group success
     */
    public function testManagerDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $browser->visit(route('panel.users.show', ['user' => $user]))
                    ->waitFor('#remove')
                    ->click('#remove')
                    ->assertRouteIs('panel.users.index');
        });
    }
    protected function captureFailuresFor($browsers) {
        foreach($browsers as $browser)
            $browser->resize(1920,1080);
        parent::captureFailuresFor($browsers);
    }
}
