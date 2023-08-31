<?php

namespace App\Tbuy\Rejection\Repository;

use App\Tbuy\Brand\DTOs\Rejection\RejectionFilterDTO;
use App\Tbuy\Rejection\DTOs\RejectionableDTO;
use App\Tbuy\Rejection\DTOs\RejectionDTO;
use App\Tbuy\Rejection\Interfaces\Rejectionable;
use App\Tbuy\Rejection\Models\Rejection;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;

class RejectionRepositoryImplementation implements RejectionRepository
{
    use HasPaginate;

    public function get(RejectionFilterDTO $filters): Builder
    {
        $lazyLoad = ['reason', 'user', 'rejectionable'];

        if ($filters->type === 'brand') {
            $lazyLoad[] = 'rejectionable.company';
            $lazyLoad[] = 'rejectionable.categories';
        }

        return  Rejection::query()
            ->with($lazyLoad)
            ->filter($filters->toArray());
    }

    public function create(Rejectionable $rejectionable, RejectionableDTO $payload, int $user_id): Rejectionable
    {
        $rejectionable->rejections()->create([
            'reason_id' => $payload->reasonId(),
            'user_id' => $user_id,
            'image' => $rejectionable->toArray(),
            'rejected_at' => now()
        ]);

        return $rejectionable;
    }

    public function update(Rejection $rejection, RejectionDTO $dto): Rejection
    {
        $rejection->update([
            'reason_id' => $dto->reasonId(),
        ]);

        return $rejection->load('reason', 'user');
    }
}
