<?php

namespace App\Tbuy\Vacancy\Services;

use App\Tbuy\Vacancy\DTOs\VacancyDTO;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Tbuy\Vacancy\Models\Vacancy;
use App\Tbuy\Vacancy\DTOs\VacancyStatusDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface VacancyService
{
    public function get(VacancyFilterDTO $filters): LengthAwarePaginator;

    public function create(VacancyDTO $payload): Vacancy;

    public function update(VacancyDTO $payload, Vacancy $vacancy): Vacancy;

    public function delete(Vacancy $vacancy): void;

    public function toggleStatus(Vacancy $vacancy, VacancyStatusDTO $payload): Vacancy;

    public function getFavoriteItems(VacancyFilterDTO $filters): LengthAwarePaginator;

}
