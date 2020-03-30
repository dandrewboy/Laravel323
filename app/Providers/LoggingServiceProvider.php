<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utility\MyLogger3;

class LoggingServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Utility\ILoggerService', function($app) {
            return new MyLogger3();
        });
    }
    
    public function provides() {
        echo "Deffered is true and I am here in provides()";
        return ['App\Utility\ILoggerService'];
    }
}
