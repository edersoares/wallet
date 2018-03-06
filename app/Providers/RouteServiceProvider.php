<?php

namespace Wallet\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Wallet\Support\Uuid;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Wallet\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('uuid', Uuid::VALID_UUID_REGEX);

        Route::bind('uuid', function ($uuid) {
            return Uuid::import($uuid);
        });

        Route::macro('api', function ($endpoint, $controller) {
            Route::get($endpoint, "{$controller}@index")->name("{$endpoint}.index");
            Route::post($endpoint, "{$controller}@create")->name("{$endpoint}.create");
            Route::get("{$endpoint}/{uuid}", "{$controller}@browse")->name("{$endpoint}.browse");
            Route::put("{$endpoint}/{uuid}", "{$controller}@update")->name("{$endpoint}.update");
            Route::delete("{$endpoint}/{uuid}", "{$controller}@delete")->name("{$endpoint}.delete");
        });

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

        $this->mapWebRoutes();

        //
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
