<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::componentNamespace('App\\View\\Components\\User', 'user');
        Blade::componentNamespace('App\\View\\Components\\Item', 'item');
        Blade::componentNamespace('App\\View\\Components\\Global', 'global');
    }
}
