<?php

namespace App\Tbuy\Vacancy\Repositories;

use App\Tbuy\User\Services\Auth\AuthService;
use App\Tbuy\Vacancy\DTOs\VacancyDTO;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Tbuy\Vacancy\DTOs\VacancyStatusDTO;
use App\Tbuy\Vacancy\Enums\VacancyStatus;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;

class VacancyRepositoryImplementation implements VacancyRepository
{
    use HasPaginate;

    public function __construct(private readonly AuthService $authRepository)
    {
    }


    public function get(VacancyFilterDTO $payload): Builder
    {
        return Vacancy::query()
            ->orderBy('created_at')
            ->orderBy('deadline')
            ->with(['category', 'images'])
            ->filter($payload->toArray())
            ->withCount('views');
    }

    public function create(VacancyDTO $payload): Vacancy
    {
        $vacancy = new Vacancy([
            'category_id' => $payload->category_id,
            'company_id' => $payload->company_id,
            'salary' => $payload->salary,
            'status' => VacancyStatus::NEW->value,
            'address' => $payload->address,
            'position' => $payload->position,
            'working_conditions' => $payload->working_conditions,
            'working_type' => $payload->working_type,
            'deadline' => $payload->deadline,
        ]);

        $vacancy = $this->addTranslations($payload, $vacancy);
        $vacancy->save();

        return $vacancy;
    }

    public function update(VacancyDTO $payload, Vacancy $vacancy): Vacancy
    {
        $vacancy->fill([
            'category_id' => $payload->category_id,
            'company_id' => $payload->company_id,
            'salary' => $payload->salary,
            'status' => $payload->status,
            'address' => $payload->address,
            'position' => $payload->position,
            'working_conditions' => $payload->working_conditions,
            'working_type' => $payload->working_type,
            'deadline' => $payload->deadline,
        ]);

        $vacancy = $this->addTranslations($payload, $vacancy);
        $vacancy->save();

        return $vacancy;
    }

    public function delete(Vacancy $vacancy): void
    {
        $vacancy->delete();
    }

    public function setStatus(Vacancy $vacancy, VacancyStatusDTO $payload): Vacancy
    {
        $vacancy->fill([
            'status' => $payload->status
        ]);
        $vacancy->save();

        return $vacancy;
    }

    protected function addTranslations(VacancyDTO $payload, Vacancy $vacancy): Vacancy
    {
        return $vacancy
            ->setTranslations('title', $payload->title)
            ->setTranslations('description', $payload->description);
    }

    public function getFavoriteItems(): Builder
    {
        $user = $this->authRepository->getAuthUser();

        return $user->getFavoriteItems(Vacancy::class);
    }
}
