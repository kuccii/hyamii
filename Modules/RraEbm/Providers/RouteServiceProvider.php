<?php

namespace Modules\RraEbm\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Nwidart\Modules\Facades\Module;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'RraEbm';

    public function boot(): void
    {
        parent::boot();
        $this->map();
    }

    public function map(): void
    {
        $this->mapWebRoutes();
        $this->mapRestaurantRoutes();
    }

    protected function mapWebRoutes(): void
    {
        $routesPath = module_path($this->name, '/Routes/web.php');
        if (!file_exists($routesPath)) {
            return;
        }

        Route::middleware('web')->group($routesPath);
    }

    protected function mapRestaurantRoutes(): void
    {
        $routesPath = module_path($this->name, '/Routes/restaurant.php');
        if (!file_exists($routesPath)) {
            return;
        }

        Route::middleware('web')->group($routesPath);
    }
}
