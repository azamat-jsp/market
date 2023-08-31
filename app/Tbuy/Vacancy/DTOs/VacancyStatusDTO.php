<?php

namespace App\Tbuy\Vacancy\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use App\Tbuy\Rejection\DTOs\RejectionableDTO;

class VacancyStatusDTO extends BaseDTO implements RejectionableDTO
{
    public readonly VacancyStatus $status;

    public function __construct(
        string               $status,
        public readonly ?int $reason_id = null
    )
    {
        $this->status = VacancyStatus::tryFrom($status);
    }

    public function reasonId(): ?int
    {
        return $this->reason_id;
    }
}
