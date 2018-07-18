<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        Route::middleware(['web', 'auth'])
        ->prefix('hris')
        ->namespace($this->namespace.'\Hris')
        ->group(base_path('routes/hris.php'));

        Route::middleware(['web'])
        ->prefix('marketing-idea')
        ->namespace($this->namespace.'\MIdea')
        ->group(base_path('routes/midea.php'));

        Route::middleware(['web'])
        ->prefix('warehouse')
        ->namespace($this->namespace.'\Warehouse')
        ->group(base_path('routes/warehouse.php'));

        Route::middleware(['web'])
        ->prefix('help-desk')
        ->namespace($this->namespace.'\HelpDesk')
        ->group(base_path('routes/help-desk.php'));

        Route::middleware(['web'])
        ->prefix('fleet-management')
        ->namespace($this->namespace.'\Fleet')
        ->group(base_path('routes/fleet.php'));

        Route::middleware(['web'])
        ->prefix('api')
        ->namespace($this->namespace.'\Fleet')
        ->group(base_path('routes/fleet_api.php'));

        $this->mapWebRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
    }
}
