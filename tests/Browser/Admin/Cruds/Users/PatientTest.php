<?php

namespace Tests\Browser\Admin\Cruds\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class PatientTest extends DuskTestCase{
    /**
     * @group admin_permission
     * @group edit
     * @group patient_crud
     * @group success
     */
    public function testPatientCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_patient1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.patient'))
                    ->waitFor('#username')
                    ->value('#username', 'test_patient1')
                    ->value('#password', 'test_patient1')
                    ->value('#password_confirmation', 'test_patient1')
                    ->value('#first_name', 'امیر')
                    ->value('#last_name', 'یاحقی')
                    ->value('#phone', '09213225675')
                    ->value('#id_number', '3388447733')
                    ->select('#birth_year')
                    ->select('#birth_month')
                    ->select('#birth_day')
                    ->select('#gender')
                    ->click('#submit')
                    ->assertTitleContains('امیر');
        });
    }
    /**
     * @group admin_permission
     * @group edit
     * @group patient_crud
     * @group fail
     * @group username
     */
    public function testPatientEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
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
     * @group edit
     * @group patient_crud
     * @group fail
     * @group phone
     */
    public function testPatientEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
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
     * @group edit
     * @group patient_crud
     * @group success
     */
    public function testPatientEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->waitFor('#username')
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    /**
     * @group admin_permission
     * @group success
     * @group patient_crud
     * @group remove
     */
    public function testPatientDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
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
