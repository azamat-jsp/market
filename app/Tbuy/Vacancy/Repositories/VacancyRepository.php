<?php

namespace App\Tbuy\Vacancy\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\Vacancy\DTOs\VacancyDTO;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\DTOs\VacancyStatusDTO;
use Illuminate\Database\Eloquent\Builder;

interface VacancyRepository extends PaginatableContract
{
    public function get(VacancyFilterDTO $payload): Builder;

    public function create(VacancyDTO $payload): Vacancy;

    public function update(VacancyDTO $payload, Vacancy $vacancy): Vacancy;

    public function delete(Vacancy $vacancy): void;

    public function setStatus(Vacancy $vacancy, VacancyStatusDTO $payload): Vacancy;

    public function getFavoriteItems(): Builder;
}
