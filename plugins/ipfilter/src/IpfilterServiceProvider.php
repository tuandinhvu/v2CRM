<?php

namespace v2CRM\Ipfilter;

use Illuminate\Support\ServiceProvider;

class IpfilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__.'/migrations');
	    $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'Ipfilter');
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/ipfilter'),
        ], 'public');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'Ipfilter');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
