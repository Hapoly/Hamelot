<?php

namespace Tests\Browser\Admin;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class PatientTest extends DuskTestCase{
    public function testPatientCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_patient1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.patient'))
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
    public function testPatientEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testPatientEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testPatientEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    public function testPatientDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_patient1')->first();
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
