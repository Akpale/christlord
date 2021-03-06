<?php

namespace App\Providers;

use Illuminate\Routing\urlGenerator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function boot(urlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }
    }


    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function register()
    {
        //
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS',true);
        }
    }
    
}
