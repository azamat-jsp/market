<?php

namespace App\Tbuy\Vacancy\Repositories\Client;

use App\Enums\MorphType;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\DTOs\Client\VacancyDTO;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use App\Tbuy\Vacancy\Models\Vacancy;

class VacancyRepositoryImplementation implements VacancyRepository
{
    private Company $company;
    public function create(VacancyDTO $payload): Vacancy
    {
        $vacancy = new Vacancy([
            'category_id' => $payload->category_id,
            'company_id' => $this->company->id,
            'salary' => $payload->salary,
            'status' => VacancyStatus::PENDING->value,
            'address' => $payload->address,
            'position' => $payload->position,
            'working_conditions' => $payload->working_conditions,
            'working_type' => $payload->working_type,
            'deadline' => $payload->deadline,
        ]);

        $vacancy = $this->addTranslations($vacancy, $payload);
        $vacancy->save();

        return $vacancy->loadCount(['views', 'clicks']);
    }

    private function addTranslations(Vacancy $vacancy, VacancyDTO $payload): Vacancy
    {
        return $vacancy->setTranslations('title', $payload->title)
            ->setTranslations('description', $payload->description);
    }

    public function setCompany(Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
