<?php

namespace Tests\Browser\Admin;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class NurseTest extends DuskTestCase{
    public function testNurseCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_nurse1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.nurse'))
                    ->value('#username', 'test_nurse1')
                    ->value('#password', 'test_nurse1')
                    ->value('#password_confirmation', 'test_nurse1')
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
    public function testNurseEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_nurse1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testNurseEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_nurse1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testNurseEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_nurse1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    public function testNurseDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_nurse1')->first();
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
