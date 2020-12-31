<?php

namespace v2CRM\Post;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/views', 'Post');
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/post'),
        ], 'public');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'Post');
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
