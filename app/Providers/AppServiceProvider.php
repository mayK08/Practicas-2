<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Forzar que Laravel use siempre el dominio configurado en APP_URL
        if (config('app.url')) {
            URL::forceRootUrl(config('app.url'));
        }

        // Forzar esquema https en todas las URLs generadas
        URL::forceScheme('https');
    }
}

