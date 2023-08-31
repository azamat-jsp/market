<?php

namespace App\Tbuy\Vacancy\Repositories\Client;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\DTOs\Client\VacancyDTO;
use App\Tbuy\Vacancy\Models\Vacancy;

interface VacancyRepository
{
    public function create(VacancyDTO $payload): Vacancy;

    public function setCompany(Company $company): static;
}
