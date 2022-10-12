<?php

namespace Modules\Website\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Website\User\Repositories\AuthRepository;
use Modules\Website\User\Repositories\AlbumRepository;
use Modules\Website\User\Repositories\PictureRepository;
use Modules\Website\User\Repositories\AuthRepositoryInterface;
use Modules\Website\User\Repositories\AlbumRepositoryInterface;
use Modules\Website\User\Repositories\PictureRepositoryInterface;

class UserModuleServiceProvider extends ServiceProvider
{

    protected $moduleNamespace = 'Modules\Website\User\Http\Controllers';
    protected $webRoute = 'Modules/Website/User/Routes/web.php';
    protected $apiRoute = 'Modules/Website/User/Routes/api.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerApiRoutes();
        $this->registerMigrations();
    }


    protected function registerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->webRoute));
    }

    protected function registerApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->apiRoute));
    }

    /**
     * Register module migrations.
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function register()
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        $this->app->bind(PictureRepositoryInterface::class, PictureRepository::class);
    }
}
