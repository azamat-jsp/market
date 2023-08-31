<?php

namespace App\Tbuy\Resume\Providers;

use App\Tbuy\Resume\Repositories\ResumeRepository;
use App\Tbuy\Resume\Repositories\ResumeRepositoryImplementation;
use App\Tbuy\Resume\Services\ResumeService;
use App\Tbuy\Resume\Services\ResumeServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ResumeService::class, ResumeServiceImplementation::class);
        $this->app->bind(ResumeRepository::class, ResumeRepositoryImplementation::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
