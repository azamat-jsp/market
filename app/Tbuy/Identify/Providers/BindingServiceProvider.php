<?php

namespace App\Tbuy\Identify\Providers;

use App\Tbuy\Identify\Repositories\IdentifyRepository;
use App\Tbuy\Identify\Repositories\IdentifyRepositoryImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IdentifyRepository::class, IdentifyRepositoryImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
