<?php

namespace Tests\Browser\Admin;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class UsersCrudTest extends DuskTestCase{
    /**
     * admin crud test
     */
    public function testAdminCreate(){
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
    /**
     * manager crud test
     */
    public function testManagerCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_manager1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.manager'))
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
    public function testManagerEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testManagerEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testManagerEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    public function testManagerDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_manager1')->first();
            $browser->visit(route('panel.users.show', ['user' => $user]))
                    ->click('#remove')
                    ->assertRouteIs('panel.users.index');
        });
    }
    /**
     * doctors crud test
     */
    public function testDoctorCreate(){
        $this->browse(function (Browser $browser){
            User::where('username', 'test_doctor1')->delete();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user)
                    ->visit(route('panel.users.create.doctor'))
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
    public function testDoctorEditUsernameUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#username', $other_user->username)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testDoctorEditPhoneUnique(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
            $other_user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#phone', $other_user->phone)
                    ->click('#submit')
                    ->assertSee('تکراری');        
        });
    }
    public function testDoctorEditSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
            $browser->visit(route('panel.users.edit', ['user' => $user]))
                    ->value('#first_name', 'احمد')
                    ->click('#submit')
                    ->assertRouteIs('panel.users.show', ['user' => $user]);
        });
    }
    public function testDoctorDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $user = User::where('username', 'test_doctor1')->first();
            $browser->visit(route('panel.users.show', ['user' => $user]))
                    ->click('#remove')
                    ->assertRouteIs('panel.users.index');
        });
    }
    /**
     * nurses crud
     */
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
    /**
     * patient crud test
     */
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
