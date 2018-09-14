<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

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

        // blade aliases
        Blade::include('components.buttons.submit', 'submit');
        Blade::include('components.forms.submit_row', 'submit_row');

        Blade::include('components.pagination', 'pagination');
        Blade::include('components.forms.inputs.text', 'input_text');
        Blade::include('components.forms.inputs.radio', 'input_radio');
        Blade::include('components.forms.inputs.geo_picker', 'input_geo_picker');
        Blade::include('components.forms.inputs.city', 'input_city');
        Blade::include('components.forms.inputs.filter_city', 'filter_city');
        Blade::include('components.forms.inputs.number', 'input_number');
        Blade::include('components.forms.inputs.date', 'input_date');
        Blade::include('components.forms.inputs.select', 'input_select');
        Blade::include('components.forms.inputs.image', 'input_image');
        Blade::include('components.forms.inputs.autocomplete', 'autocomplete');
        Blade::include('components.forms.inputs.filter_autocomplete', 'filter_autocomplete');

        Blade::component('components.forms.structures.create', 'form_create');
        Blade::component('components.forms.structures.edit', 'form_edit');
        Blade::component('components.others.pane_tagline', 'tagline');
        Blade::include('components.forms.structures.operations.th', 'operation_th');

        Blade::component('components.forms.structures.table', 'table');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
