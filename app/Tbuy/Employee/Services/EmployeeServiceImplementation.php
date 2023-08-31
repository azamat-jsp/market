<?php

namespace App\Tbuy\Employee\Services;

use App\Tbuy\Company\Repositories\CompanyRepository;
use App\Tbuy\Employee\DTOs\EmployeeDTO;
use App\Tbuy\Employee\DTOs\EmployeeFilterDTO;
use App\Tbuy\Employee\DTOs\EmployeeLoginDTO;
use App\Tbuy\Employee\DTOs\EmployeeResetPasswordDTO;
use App\Tbuy\Employee\Enums\CacheKey;
use App\Tbuy\Employee\Jobs\SendRegisterEmailJob;
use App\Tbuy\Employee\Models\CompanyEmployee;
use App\Tbuy\Employee\Notifications\ResetPasswordNotification;
use App\Tbuy\Employee\Repositories\EmployeeRepository;
use App\Tbuy\Permission\Cabinet\Services\CabinetPermissionService;
use App\Tbuy\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EmployeeServiceImplementation implements EmployeeService
{
    public function __construct(
        protected readonly EmployeeRepository $employeeRepository,
        protected readonly UserRepository     $userRepository,
        protected readonly CompanyRepository  $companyRepository,
        protected readonly CabinetPermissionService  $cabinetPermissionService
    ) {
    }

    public function list(EmployeeFilterDTO $dto): Collection
    {
        return Cache::tags(CacheKey::TAG->value)
            ->remember(CacheKey::LIST->setKeys($dto), CacheKey::ttl(), function () use ($dto) {
                return $this->employeeRepository->list($dto);
            });
    }

    public function create(EmployeeDTO $dto): CompanyEmployee
    {
        $user = $this->userRepository->findByEmail($dto->email);
        $permissions = $this->cabinetPermissionService->getPermissionPageByRequest($dto->permissions);
        $company = $this->companyRepository->getById($dto->company_id);

        $employee = DB::transaction(fn() => $this->employeeRepository->create($user, $dto, $permissions));

        Cache::tags(CacheKey::TAG->value)->clear();

        SendRegisterEmailJob::dispatch($dto->email, $dto->username, $dto->password, $company);

        return $employee;
    }

    public function update(CompanyEmployee $employee, EmployeeDTO $dto): CompanyEmployee
    {
        $user = $this->userRepository->findByEmail($dto->email);
        $permissions = $this->cabinetPermissionService->getPermissionPageByRequest($dto->permissions);

        $employee = DB::transaction(fn() => $this->employeeRepository->update($user, $employee, $dto, $permissions));

        Cache::tags(CacheKey::TAG->value)->clear();

        return $employee;
    }

    public function delete(CompanyEmployee $employee): void
    {
        $this->employeeRepository->delete($employee);

        Cache::tags(CacheKey::TAG->value)->clear();
    }

    public function loadRelations(CompanyEmployee $employee): CompanyEmployee
    {
        return $this->employeeRepository->loadRelations($employee);
    }

    public function login(EmployeeLoginDTO $dto): CompanyEmployee|null
    {
        $employee = $this->employeeRepository->login($dto);

        if ($employee) {
            auth()->login($employee->user);
        }

        return $employee;
    }

    public function resetPassword(EmployeeResetPasswordDTO $dto): CompanyEmployee|null
    {
        $employee = $this->employeeRepository->resetPassword($dto);

        $user = $employee->user;
        $user->notify(new ResetPasswordNotification($dto->password, $dto->company_id, $dto->username));

        return $employee;
    }
}
