<?php

namespace App\Tbuy\Gallery\Providers;

use App\Tbuy\Gallery\Repositories\GalleryRepository;
use App\Tbuy\Gallery\Repositories\GalleryRepositoryImplementation;
use App\Tbuy\Gallery\Services\GalleryService;
use App\Tbuy\Gallery\Services\GalleryServiceImplementation;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider

{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GalleryRepository::class, GalleryRepositoryImplementation::class);
        $this->app->bind(GalleryService::class, GalleryServiceImplementation::class);
    }
}
