<?php

namespace App\Tbuy\View\Providers;

use App\Tbuy\View\Repositories\ViewRepository;
use App\Tbuy\View\Repositories\ViewRepositoryImplementation;
use App\Tbuy\View\Services\ViewService;
use App\Tbuy\View\Services\ViewServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ViewService::class, ViewServiceImplementation::class);
        $this->app->bind(ViewRepository::class, ViewRepositoryImplementation::class);
    }

    public function boot(): void
    {
    }
}
