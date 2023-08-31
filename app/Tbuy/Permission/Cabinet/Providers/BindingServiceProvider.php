<?php

namespace App\Tbuy\Permission\Cabinet\Providers;

use App\Tbuy\Permission\Cabinet\Repositories\CabinetPermissionRepository;
use App\Tbuy\Permission\Cabinet\Repositories\CabinetPermissionRepositoryImplementation;
use App\Tbuy\Permission\Cabinet\Services\CabinetPermissionService;
use App\Tbuy\Permission\Cabinet\Services\CabinetPermissionServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CabinetPermissionRepository::class, CabinetPermissionRepositoryImplementation::class);
        $this->app->bind(CabinetPermissionService::class, CabinetPermissionServiceImplementation::class);
    }
}
