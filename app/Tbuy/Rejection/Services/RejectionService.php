<?php

namespace App\Tbuy\Rejection\Services;

use App\Tbuy\Brand\DTOs\Rejection\RejectionCreateDTO;
use App\Tbuy\Brand\DTOs\Rejection\RejectionFilterDTO;
use App\Tbuy\Rejection\DTOs\RejectionDTO;
use App\Tbuy\Rejection\Models\Rejection;
use Illuminate\Pagination\LengthAwarePaginator;

interface RejectionService
{
    public function get(RejectionFilterDTO $filters): LengthAwarePaginator;

    public function create(RejectionCreateDTO $rejectionCreateDTO): Rejection;

    public function update(Rejection $rejection, RejectionDTO $dto): Rejection;
}
