<?php

namespace Tests\Browser\Admin\Cruds\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

/**
 * test level: 2
 */
class DoctorTest extends DuskTestCase{
    /**
     * @group permission_admin
     * @group doctor_crud
     * @group create
     * @group username
     * @group fail
     */
    public function testDoctorCreateUsername(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_doctor1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.doctor'))
                    ->value('#username', env('TEST_ADMIN_USERNAME'))
                    ->value('#password', 'test_doctor1')
                    ->value('#password_confirmation', 'test_doctor1')
                    ->select('#field_id')
                    ->select('#degree_id')
                    ->select('#gender')
                    ->value('#msc', '48923228')
                    ->select('#public')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertSee(__('validation.unique', ['attribute' => __('validation.attributes.username')]));
        });
    }
    /**
     * @group permission_admin
     * @group doctor_crud
     * @group create
     * @group password
     * @group fail
     */
    public function testDoctorCreatePassword(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_doctor1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.doctor'))
                    ->waitFor('#username')
                    ->value('#username', 'test_doctor1')
                    ->value('#password', 'test_doctor2')
                    ->value('#password_confirmation', 'test_doctor1')
                    ->select('#field_id')
                    ->select('#degree_id')
                    ->select('#gender')
                    ->value('#msc', '48923228')
                    ->select('#public')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertSee(__('validation.confirmed', ['attribute' => __('validation.attributes.password')]));
        });
    }
    /**
     * @group permission_admin
     * @group doctor_crud
     * @group create
     * @group success
     * @group fail
     */
    public function testDoctorCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_doctor1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.doctor'))
                    ->waitFor('#username')
                    ->value('#username', 'test_doctor1')
                    ->value('#password', 'test_doctor1')
                    ->value('#password_confirmation', 'test_doctor1')
                    ->select('#field_id')
                    ->select('#degree_id')
                    ->select('#gender')
                    ->value('#msc', '48923228')
                    ->select('#public')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->click('#submit')
                    ->assertTitleContains('امیر');
        });
    }
    /**
     * @group permission_admin
     * @group doctor_crud
     * @group edit
     * @group username
     * @group fail
     */
    public function testDoctorEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
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
     * @group doctor_crud
     * @group edit
     * @group phone
     * @group fail
     */
    public function testDoctorEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
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
     * @group doctor_crud
     * @group edit
     * @group success
     */
    public function testDoctorEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    /**
     * @group permission_admin
     * @group doctor_crud
     * @group delete
     * @group success
     */
    public function testDoctorDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
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
