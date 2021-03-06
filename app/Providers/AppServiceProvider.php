<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Resources\Json\Resource;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();

        // blade aliases
        Blade::include('components.buttons.submit', 'submit');
        Blade::include('components.forms.submit_row', 'submit_row');

        Blade::include('components.pagination', 'pagination');
        Blade::include('components.forms.inputs.text', 'input_text');
        Blade::include('components.forms.inputs.text_area', 'input_text_area');
        Blade::include('components.forms.inputs.radio', 'input_radio');
        Blade::include('components.forms.inputs.geo_picker', 'input_geo_picker');
        Blade::include('components.forms.inputs.city', 'input_city');
        Blade::include('components.forms.inputs.filter_city', 'filter_city');
        Blade::include('components.forms.inputs.number', 'input_number');
        Blade::include('components.forms.inputs.currency', 'input_currency');
        Blade::include('components.forms.inputs.date', 'input_date');
        Blade::include('components.forms.inputs.date_complete', 'input_date_complete');
        Blade::include('components.forms.inputs.day_time', 'input_day_time');
        Blade::include('components.forms.inputs.filter_date_complete', 'filter_date_complete');
        Blade::include('components.forms.inputs.select', 'input_select');
        Blade::include('components.forms.inputs.image', 'input_image');
        Blade::include('components.forms.inputs.image_multi', 'input_multi_image');
        Blade::include('components.forms.inputs.autocomplete', 'autocomplete');
        Blade::include('components.forms.inputs.multi_autocomplete', 'multiautocomplete');
        Blade::include('components.forms.inputs.filter_autocomplete', 'filter_autocomplete');

        Blade::component('components.forms.structures.create', 'form_create');
        Blade::component('components.forms.structures.edit', 'form_edit');
        Blade::component('components.others.pane_tagline', 'tagline');
        Blade::include('components.forms.structures.operations.th', 'operation_th');
        Blade::include('components.forms.structures.operations.th_rg', 'operation_th_rg');

        Blade::component('components.forms.structures.table', 'table');



        // dashboard components
        Blade::include('components.dashboard.users', 'dashboard_users');
        Blade::include('components.dashboard.wallet', 'dashboard_wallet');
        Blade::include('components.dashboard.units', 'dashboard_units');
        Blade::include('components.dashboard.bids', 'dashboard_bids');
        Blade::include('components.dashboard.demands', 'dashboard_demands');
        Blade::include('components.dashboard.open_bids', 'dashboard_open_bids');

        Blade::include('components.dashboard.last_users', 'dashboard_last_users');
        Blade::include('components.dashboard.last_transactions', 'dashboard_last_transactions');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
        //
    }
}
