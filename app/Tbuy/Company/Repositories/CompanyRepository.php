<?php

namespace App\Tbuy\Company\Repositories;

use App\Contracts\PaginatableContract;
use App\DTOs\BaseDTO;
use App\Tbuy\Company\DTOs\CompanyDataConfirmationDTO;
use App\Tbuy\Company\DTOs\CompanyDTO;
use App\Tbuy\Company\DTOs\CompanyFilterDTO;
use App\Tbuy\Company\DTOs\CompanyStatusDTO;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyRepository extends PaginatableContract
{
    public function get(CompanyFilterDTO $payload): Collection;

    public function getBuilder(CompanyFilterDTO $payload): Builder;

    public function create(CompanyDTO $payload): Company;

    public function update(Company $company, BaseDTO $payload): Company;

    public function delete(Company $company): bool;

    public function setStatus(Company $company, CompanyStatusDTO $payload): Company;

    public function getById(int $companyId): Company;

    public function purchasesRefunds(Company $company): float|int;

    public function score(Company $company, ?int $score): Company;

    public function getEmployeesByCompany(Company $company): Collection;

    public function getsInfoByCompany(Company $company): array;

    public function updateFieldsDataConfirmation(Company $company, CompanyDataConfirmationDTO $payload): Company;

    public function getVacanciesByCompany(Company $company, VacancyFilterDTO $dto): Builder;

    public function getScoresByCompany(Company $company): array;

    public function updateDomain(Company $company, string $domain): Company;
}

