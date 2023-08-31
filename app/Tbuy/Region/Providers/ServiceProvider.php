<?php

namespace App\Tbuy\Region\Providers;

use App\Tbuy\Region\Services\RegionService;
use App\Tbuy\Region\Services\RegionServiceImplementation;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Tbuy\Region\Repositories\RegionRepository;
use App\Tbuy\Region\Repositories\RegionRepositoryImplementation;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RegionService::class, RegionServiceImplementation::class);
        $this->app->bind(RegionRepository::class, RegionRepositoryImplementation::class);

    }
}
