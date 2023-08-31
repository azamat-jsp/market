<?php

namespace App\Tbuy\Click\Providers;

use App\Tbuy\Click\Repositories\ClickRepository;
use App\Tbuy\Click\Repositories\ClickRepositoryImplementation;
use App\Tbuy\Click\Services\ClickService;
use App\Tbuy\Click\Services\ClickServiceImplementation;
use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ClickService::class, ClickServiceImplementation::class);
        $this->app->bind(ClickRepository::class, ClickRepositoryImplementation::class);
    }

    public function boot(): void
    {
    }
}
