<?php

namespace App\Tbuy\MediaLibrary\Providers;

use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepositoryImplementation;
use App\Tbuy\MediaLibrary\Services\MediaLibraryService;
use App\Tbuy\MediaLibrary\Services\MediaLibraryServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MediaLibraryRepository::class, MediaLibraryRepositoryImplementation::class);
        $this->app->bind(MediaLibraryService::class, MediaLibraryServiceImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
