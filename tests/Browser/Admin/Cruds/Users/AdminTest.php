<?php

namespace Tests\Browser\Admin\Cruds\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

/**
 * test level: 2
 */
class AdminTest extends DuskTestCase{
    /**
     * @group permission_admin
     * @group admin_crud
     * @group create
     * @group password
     * @group fail
     */
    public function testAdminCreatePassword(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_admin1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.users.create.admin'))
                    ->waitFor('#username')
                    ->value('#username', 'test_admin1')
                    ->value('#password', 'test_admin2')
                    ->value('#password_confirmation', 'test_admin1')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertSee(__('validation.confirmed', ['attribute' => __('validation.attributes.password')]));
            // $browser->value('#password', '')
            //         ->click('#submit')
            //         ->assertSee(__('validation.required', ['attribute' => __('validation.attributes.password')]));
        });
    }
    /**
     * @group permission_admin
     * @group admin_crud
     * @group create
     * @group username
     * @group fail
     */
    public function testAdminCreateUsername(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_admin1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.users.create.admin'))
                    ->waitFor('#username')
                    ->value('#username', env('TEST_ADMIN_USERNAME'))
                    ->value('#password', 'test_admin1')
                    ->value('#password_confirmation', 'test_admin1')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertSee(__('validation.unique', ['attribute' => __('validation.attributes.username')]));
            // $browser->value('#password', '')
            //         ->click('#submit')
            //         ->assertSee(__('validation.required', ['attribute' => __('validation.attributes.password')]));
        });
    }
    /**
     * @group permission_admin
     * @group admin_crud
     * @group create
     * @group success
     */
    public function testAdminCreateSuccess(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_admin1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.admin'))
                    ->waitFor('#username')
                    ->value('#username', 'test_admin1')
                    ->value('#password', 'test_admin1')
                    ->value('#password_confirmation', 'test_admin1')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertTitleContains('امیر');
        });
    }
    /**
     * @group permission_admin
     * @group admin_crud
     * @group edit
     * @group username
     * @group fail
     */
    public function testAdminEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    /**
     * @group permission_admin
     * @group admin_crud
     * @group edit
     * @group phone
     * @group fail
     */
    public function testAdminEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    /**
     * @group permission_admin
     * @group admin_crud
     * @group edit
     * @group success
     */
    public function testAdminEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    /**
     * @group permission_admin
     * @group admin_crud
     * @group delete
     * @group success
     */
    public function testAdminDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
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
