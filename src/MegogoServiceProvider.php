<?php

namespace xnf4o\Megogo;

use Illuminate\Support\ServiceProvider;

class MegogoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'xnf4o');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'xnf4o');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/megogo.php', 'megogo');

        // Register the service the package provides.
        $this->app->singleton('megogo', function ($app) {
            return new Megogo;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['megogo'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/megogo.php' => config_path('megogo.php'),
        ], 'megogo.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/xnf4o'),
        ], 'megogo.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/xnf4o'),
        ], 'megogo.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/xnf4o'),
        ], 'megogo.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
