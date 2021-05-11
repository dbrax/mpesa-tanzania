<?php

namespace Epmnzava\MpesaTanzania;

use Illuminate\Support\ServiceProvider;

class MpesaTanzaniaServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mpesa-tanzania');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'mpesa-tanzania');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mpesa-tanzania.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/mpesa-tanzania'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/mpesa-tanzania'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/mpesa-tanzania'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mpesa-tanzania');

        // Register the main class to use with the facade
        $this->app->singleton('mpesa-tanzania', function () {
            return new MpesaTanzania;
        });
    }
}
