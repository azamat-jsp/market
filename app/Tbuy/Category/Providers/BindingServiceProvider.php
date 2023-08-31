<?php

namespace App\Tbuy\Category\Providers;

use App\Tbuy\Category\Repositories\CategoryRepository;
use App\Tbuy\Category\Repositories\CategoryRepositoryImplementation;
use App\Tbuy\Category\Services\CategoryService;
use App\Tbuy\Category\Services\CategoryServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryService::class, CategoryServiceImplementation::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
