<?php

namespace DeveloperNaren\Fb;

use DeveloperNaren\FB\Facebook;
use Illuminate\Support\ServiceProvider;

class FbServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/fb.php' => config_path('fb.php')
        ], 'config');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register( )
    {
        app()->singleton('FB', function() {

            $config = [
                'key' => config('fb.key'),
                'secret' => config('fb.secret'),
                'redirect' => config('fb.redirect')
            ];


            return new Facebook( $config );
        });

    }
}