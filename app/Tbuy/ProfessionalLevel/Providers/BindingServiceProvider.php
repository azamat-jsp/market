<?php

namespace App\Tbuy\ProfessionalLevel\Providers;

use App\Tbuy\ProfessionalLevel\Repositories\ProfessionalLevelRepository;
use App\Tbuy\ProfessionalLevel\Repositories\ProfessionalLevelRepositoryImplementation;
use App\Tbuy\ProfessionalLevel\Services\ProfessionalLevelService;
use App\Tbuy\ProfessionalLevel\Services\ProfessionalLevelServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProfessionalLevelRepository::class, ProfessionalLevelRepositoryImplementation::class);
        $this->app->bind(ProfessionalLevelService::class, ProfessionalLevelServiceImplementation::class);
    }

    public function boot(): void
    {
    }
}
