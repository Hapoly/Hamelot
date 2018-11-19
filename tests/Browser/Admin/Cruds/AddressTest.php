<?php

namespace Tests\Browser\Admin\Cruds;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Models\Address;

/**
 * test level: 2
 */
class AddressTest extends DuskTestCase{
    /**
     * @group admin_permission
     * @group address_crud
     * @group create
     * @group success
     */
    public function testAddressCreatePassword(){
        $this->browse(function (Browser $browser){
            Address::where('title', 'test_address')->delete();
            Address::where('title', 'test_address2')->delete();
            
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.addresses.create'))
                    ->value('#title', 'test_address')
                    ->value('#plain', 'test_address_plain')
                    ->value('#phone', '09215847384')
                    ->value('#full_name', User::where('group_code', User::G_PATIENT)->first()->full_name)
                    ->select('#province_id')
                    ->select('#city_id')
                    ->click('#submit')
                    ->assertRouteIs('panel.addresses.show', ['address' => Address::where('title', 'test_address')->first()]);
        });
    }
    /**
     * @group admin_permission
     * @group address_crud
     * @group edit
     * @group success
     */
    public function testAddressEditSuccess(){
        $this->browse(function (Browser $browser){
            $address = Address::where('title', 'test_address')->first();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.addresses.edit', ['address' => $address]))
                    ->value('#title', 'test_address2')
                    ->value('#plain', 'test_address_plain')
                    ->value('#phone', '09215847484')
                    ->select('#province_id')
                    ->select('#city_id')
                    ->click('#submit')
                    ->assertRouteIs('panel.addresses.show', ['address' => $address]);
        });
    }
    /**
     * @group admin_permission
     * @group address_crud
     * @group delete
     * @group success
     */
    public function testAddressDeleteSuccess(){
        $this->browse(function (Browser $browser){
            $address = Address::where('title', 'test_address2')->first();
            $user = User::where('username', env('TEST_ADMIN_USERNAME'))->first();
            $browser->loginAs($user);
            $browser->visit(route('panel.addresses.show', ['address' => $address]))
                    ->click('#remove')
                    ->assertRouteIs('panel.addresses.index');
        });
    }
    protected function captureFailuresFor($browsers) {
        foreach($browsers as $browser)
            $browser->resize(1920,1080);
        parent::captureFailuresFor($browsers);
    }
}
