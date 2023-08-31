<?php

namespace App\Tbuy\Vacancy\Listeners;

use App\Tbuy\Vacancy\Events\VacancyRejected;
use App\Tbuy\Vacancy\Repositories\VacancyRepository;
use App\Tbuy\Rejection\Repository\RejectionRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class VacancyRejectedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly RejectionRepository $rejectionRepository
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VacancyRejected $event): void
    {
        $this->rejectionRepository->create(
            $event->vacancy,
            $event->payload,
            $event->user_id
        );
    }

}
