<?php

namespace Webkul\Aba\Providers;

use Illuminate\Support\ServiceProvider;


class AbaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'aba');
        
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'aba');

        
        $this->publishes([
            __DIR__ . '/../Resources/views/payment.blade.php' => resource_path('themes/default/views/checkout/onepage/payment.blade.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/review.blade.php' => resource_path('themes/default/views/checkout/onepage/review.blade.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->registerConfig();
    }
  
    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/paymentmethods.php', 'paymentmethods'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
    }
}
