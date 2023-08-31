<?php

namespace App\Tbuy\Resume\Services;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Resume\DTOs\ResumeFilterDTO;
use App\Tbuy\Resume\Enums\CacheKey;
use App\Tbuy\Resume\DTOs\GuestResumeDTO;
use App\Tbuy\Resume\DTOs\ResumeDTO;
use App\Tbuy\Resume\Model\Resume;
use App\Tbuy\Resume\Repositories\ResumeRepository;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ResumeServiceImplementation implements ResumeService
{
    public function __construct(
        private readonly ResumeRepository $resumeRepository,
    )
    {
    }

    public function store(ResumeDTO $dto): Resume
    {
        return $this->resumeRepository->store($dto);
    }

    public function get(ResumeFilterDTO $dto, Company $company): LengthAwarePaginator
    {
        $query = $this->resumeRepository->get($dto, $company);

        return Cache::tags(CacheKey::LIST->value)
            ->remember(
                key: CacheKey::LIST->setKeys($dto),
                ttl: CacheKey::ttl(),
                callback: fn() => $this->resumeRepository->paginate($query, $dto->perPage)
            );
    }

    public function guestStore(GuestResumeDTO $dto): Resume
    {
        return $this->resumeRepository->guestStore($dto);
    }

    public function feedbackOnThisVacancy(Vacancy $vacancy): Collection
    {
        return $this->resumeRepository->feedbackOnThisVacancy($vacancy);
    }
}
