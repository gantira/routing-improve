<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

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

        $this->mapWebRoutes();

        //PANGGIL FUNGSI YANG SUDAH DIBUAT SEBELUMNYA
        $this->mapBackendRoutes();
        $this->mapFrontendRoutes();
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

    //FUNGSI INI UNTUK MENGHANDLE ROUTE BACKEND
    protected function mapBackendRoutes()
    {
        //MIDDLEWA YANG DIGUNAKAN KITA SAMAKAN SAJA DENGAN ROUTE DEFAULT WEB.PHP YANG AKAN MENGGUNAKAN MIDDLEWARE ROUTE
        //KARENA FUNGSINYA SAMA HANYA SAJA DIPISAHKAN FILENYA
        Route::middleware('web')
            //BAGIAN YANG BERBEDA HANYA PENAMBAHAN PREFIX ADMINISTRATOR
            //DIMANA ROUTE YANG ADA DIDALAM FILE /BACKEND/WEB.PHP
            //URLNYA AKAN DIMULAI DENGAN /ADMINISTRATOR
            ->prefix('administrator')
            ->namespace($this->namespace)
            //ARAHKAN KE FILE YANG DITUJU, YAKNI ROUTES/BACKEND/WEB.PHP
            ->group(base_path('routes/backend/web.php'));
    }

    //FUNGSI INI AKAN MENGHANDLE ROUTE FRONTEND
    //ADAPUN PENJELASANNYA SAMA SAJA
    protected function mapFrontendRoutes()
    {
        Route::middleware('web')
            ->prefix('member')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/web.php'));
    }
}
