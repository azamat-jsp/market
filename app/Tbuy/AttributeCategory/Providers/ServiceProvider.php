<?php

namespace App\Tbuy\AttributeCategory\Providers;

use App\Tbuy\AttributeCategory\Repositories\AttributeCategoryRepository;
use App\Tbuy\AttributeCategory\Repositories\AttributeCategoryRepositoryImplementation;
use App\Tbuy\AttributeCategory\Services\AttributeCategoryService;
use App\Tbuy\AttributeCategory\Services\AttributeCategoryServiceImplementation;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AttributeCategoryService::class, AttributeCategoryServiceImplementation::class);
        $this->app->bind(AttributeCategoryRepository::class, AttributeCategoryRepositoryImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
