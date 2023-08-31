<?php

namespace App\Tbuy\Vacancy\Services\Client;

use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\DTOs\Client\VacancyDTO;
use App\Tbuy\Vacancy\Models\Vacancy;

interface VacancyService
{
    public function create(VacancyDTO $payload): Vacancy;

    public function setCompany(Company $company): static;

}
