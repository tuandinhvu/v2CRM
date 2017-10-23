<?php

namespace v2CRM\Sample;

use Illuminate\Support\ServiceProvider;

class SampleServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/views', 'Sample');
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/sample'),
        ], 'public');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'Sample');
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
