<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    public function boot(): void
    {
        $this->routes(function () {
            // Web Routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // API Routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Admin Routes
            if (file_exists(base_path('routes/admin.php'))) {
                Route::middleware(['web', 'auth'])
                    ->prefix('admin')
                    ->group(base_path('routes/admin.php'));
            }

            // Vendor Routes
            if (file_exists(base_path('routes/vendor.php'))) {
                Route::middleware(['web', 'auth'])
                    ->prefix('vendor')
                    ->group(base_path('routes/vendor.php'));
            }

            // Auth Routes (Jetstream / Breeze)
            if (file_exists(base_path('routes/auth.php'))) {
                Route::middleware('web')
                    ->group(base_path('routes/auth.php'));
            }
        });
    }
}
