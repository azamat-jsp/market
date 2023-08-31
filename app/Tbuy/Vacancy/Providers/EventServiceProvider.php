<?php

namespace App\Tbuy\Vacancy\Providers;

use App\Tbuy\Vacancy\Events\VacancyRejected;
use App\Tbuy\Vacancy\Listeners\VacancyRejectedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        VacancyRejected::class => [
            VacancyRejectedListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
