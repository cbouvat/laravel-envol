<?php

namespace Cbouvat\Envol;

use Illuminate\Support\ServiceProvider;

class EnvolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/envol.php' => config_path('envol.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Cbouvat\Envol\Http\Controllers\EnvolController');
    }
}
