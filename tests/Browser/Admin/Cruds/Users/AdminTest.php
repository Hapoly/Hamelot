<?php

namespace Tests\Browser\Admin;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

/**
 * test level: 2
 */
class AdminTest extends DuskTestCase{
    public function testAdminCreatePassword(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_admin1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.users.create.admin'))
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
    public function testAdminCreateUsername(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_admin1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.users.create.admin'))
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
    public function testAdminCreateSuccess(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_admin1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.admin'))
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
    public function testAdminEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testAdminEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testAdminEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    public function testAdminDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_admin1')->first();
            $browser->visit(route('panel.users.show', ['user' => $user]))
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
