<?php

namespace App\Tbuy\Vacancy\Services\Client;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\DTOs\Client\VacancyDTO;
use App\Tbuy\Vacancy\Enums\VacancyCacheKey;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\Repositories\Client\VacancyRepository as ClientVacancyRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VacancyServiceImplementation implements VacancyService
{
    private Company $company;

    public function __construct(
        private readonly ClientVacancyRepository $vacancyRepository,
    )
    {
    }

    public function create(VacancyDTO $payload): Vacancy
    {
        $vacancy = DB::transaction(function () use ($payload) {
            $vacancy = $this->vacancyRepository->setCompany($this->company)->create($payload);

            return $vacancy->load('category');
        });

        Cache::tags(VacancyCacheKey::LIST)->clear();

        return $vacancy;
    }

    public function setCompany(Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
