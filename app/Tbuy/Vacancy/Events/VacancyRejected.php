<?php

namespace App\Tbuy\Vacancy\Events;

use App\Tbuy\Vacancy\DTOs\VacancyStatusDTO;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VacancyRejected implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public readonly Vacancy $vacancy,
        public readonly VacancyStatusDTO $payload,
        public readonly int $user_id,
    )
    {

    }
}
