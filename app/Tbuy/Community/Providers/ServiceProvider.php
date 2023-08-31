<?php

namespace App\Tbuy\Community\Providers;

use App\Tbuy\Community\Repositories\CommunityRepository;
use App\Tbuy\Community\Repositories\CommunityRepositoryImplementation;
use App\Tbuy\Community\Services\CommunityService;
use App\Tbuy\Community\Services\CommunityServiceImplementation;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider

{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CommunityRepository::class, CommunityRepositoryImplementation::class);
        $this->app->bind(CommunityService::class, CommunityServiceImplementation::class);
    }
}
