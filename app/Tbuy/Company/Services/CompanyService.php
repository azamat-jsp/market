<?php

namespace App\Tbuy\Company\Services;

use App\Tbuy\Company\DTOs\CompanyClientDTO;
use App\Tbuy\Company\DTOs\CompanyClientLogoDTO;
use App\Tbuy\Company\DTOs\CompanyDataConfirmationDTO;
use App\Tbuy\Company\DTOs\CompanyDTO;
use App\Tbuy\Company\DTOs\CompanyFilterDTO;
use App\Tbuy\Company\DTOs\CompanyStatusDTO;
use App\Tbuy\Company\DTOs\CompanyUpdateDTO;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Company\Requests\SendEmailRequest;
use App\Tbuy\MediaLibrary\DTOs\FileDTO;
use App\Tbuy\User\Models\User;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyService
{
    public function get(CompanyFilterDTO $filters): LengthAwarePaginator;

    public function store(CompanyDTO $dto): Company;

    public function update(Company $company, CompanyUpdateDTO $dto): Company;

    public function delete(Company $company): bool;

    public function toggleStatus(Company $company, CompanyStatusDTO $payload): Company;

    public function clientUpdate(Company $company, CompanyClientDTO $payload): Company;
    public function clientUpdateLogo(Company $company, CompanyClientLogoDTO $payload): Company;

    public function getAuthCompany(): Company;

    public function score(Company $company, ?int $score): Company;

    public function scores(Company $company): array;


    public function getEmployees(Company $company): Collection;

    public function getInfo(Company $company): Company;

    public function dataConfirmationCompany(Company $company, CompanyDataConfirmationDTO $payload): Company;

    public function sendEmailWithLinkForPassword(SendEmailRequest $request): bool;

    public function setPassword(string $email, string $password): User;

    public function vacancies(Company $company, VacancyFilterDTO $dto): LengthAwarePaginator;

    public function storeUserByCompany(Company $company): void;

    public function getDocuments(Company $company): Collection;

    public function updateDomain(Company $company, string $domain): Company;
}
