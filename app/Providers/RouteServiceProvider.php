<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware(['api', 'locale'])
                ->prefix('api/v1')
                ->name('api.v1.')
                ->group(function () {
                    $adminBuilder = Route::prefix('admin')->name('admin.');
                    $clientBuilder = Route::prefix('client')->name('client.');

                    foreach (glob(base_path("routes/admin/v1/*.php")) as $route) {
                        $adminBuilder->group($route);
                    }

                    foreach (glob(base_path("routes/client/v1/*.php")) as $route) {
                        $clientBuilder->group($route);
                    }


                });

            Route::middleware(['api', 'locale'])->prefix('api/v1')
                ->name('api.v1.')->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $this->pattern();
    }

    private function pattern() :void {
        Route::pattern('id', '[0-9]+');
        Route::pattern('vacancy', '[0-9]+');
        Route::pattern('attributeCategory', '[0-9]+');
        Route::pattern('value', '[0-9]+');
        Route::pattern('attribute', '[0-9]+');
        Route::pattern('audience', '[0-9]+');
        Route::pattern('banner', '[0-9]+');
        Route::pattern('brand', '[0-9]+');
        Route::pattern('category', '[0-9]+');
        Route::pattern('community', '[0-9]+');
        Route::pattern('company', '[0-9]+');
        Route::pattern('filial', '[0-9]+');
        Route::pattern('locale', '[0-9]+');
        Route::pattern('menu', '[0-9]+');
        Route::pattern('product', '[0-9]+');
        Route::pattern('level', '[0-9]+');
        Route::pattern('question', '[0-9]+');
        Route::pattern('region', '[0-9]+');
        Route::pattern('settings', '[0-9]+');
        Route::pattern('target', '[0-9]+');
        Route::pattern('tariff', '[0-9]+');
        Route::pattern('templates', '[0-9]+');
        Route::pattern('gallery', '[0-9]+');
        Route::pattern('employee', '[0-9]+');
        Route::pattern('resume', '[0-9]+');
    }
}
