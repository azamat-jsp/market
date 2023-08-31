<?php

namespace App\Tbuy\Employee\Repositories;

use App\Tbuy\Employee\DTOs\EmployeeDTO;
use App\Tbuy\Employee\DTOs\EmployeeFilterDTO;
use App\Tbuy\Employee\DTOs\EmployeeLoginDTO;
use App\Tbuy\Employee\DTOs\EmployeeResetPasswordDTO;
use App\Tbuy\Employee\DTOs\EmployeePermissionDTO;
use App\Tbuy\Employee\Models\CompanyEmployee;
use App\Tbuy\User\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class EmployeeRepositoryImplementation implements EmployeeRepository
{

    public function list(EmployeeFilterDTO $dto): Collection
    {
        return CompanyEmployee::query()
            ->with(['user', 'company'])
            ->filter($dto->toArray())
            ->get();
    }

    public function create(User $user, EmployeeDTO $dto, array $permissions = []): CompanyEmployee
    {
        $employee = CompanyEmployee::query()->create([
            'user_id' => $user->id,
            'company_id' => $dto->company_id,
            'username' => $dto->username,
            'password' => bcrypt($dto->password),
        ]);

        if ($permissions) {
            $user->syncPermissions($permissions);
        }

        return $this->loadRelations($employee);
    }

    public function update(User $user, CompanyEmployee $employee, EmployeeDTO $dto, array $permissions = []): CompanyEmployee
    {
        $employee->fill([
            'user_id' => $user->id,
            'company_id' => $dto->company_id,
            'username' => $dto->username
        ]);
        $employee->save();

        $user->syncPermissions($permissions);

        return $this->loadRelations($employee);
    }

    public function delete(CompanyEmployee $employee): void
    {
        $employee->delete();
    }

    public function loadRelations(CompanyEmployee $employee): CompanyEmployee
    {
        return $employee->load([
            'user',
            'company'
        ]);
    }

    public function login(EmployeeLoginDTO $dto): CompanyEmployee|null
    {
        return CompanyEmployee::query()
            ->where('company_id', $dto->company_id)
            ->whereHas('user', function (Builder $builder) use ($dto) {
                return $builder->where('users.email', $dto->email);
            })
            ->get()
            ->filter(function (CompanyEmployee $employee) use ($dto) {
                return Hash::check($dto->password, $employee->password);
            })
            ->first();
    }

    public function findByCompanyIdAndUserId(int $company_id, int $user_id): ?CompanyEmployee
    {
        return CompanyEmployee::query()
            ->where('company_id', '=', $company_id)
            ->where('user_id', '=', $user_id)
            ->first();
    }

    public function resetPassword(EmployeeResetPasswordDTO $dto): CompanyEmployee|null
    {
        $employee = CompanyEmployee::query()->where('company_id', $dto->company_id)
            ->where('username', $dto->username)
            ->whereHas('user', fn (Builder $q) => $q->where('email', $dto->email))
            ->firstOrFail();

        $employee->update([
            'password' => Hash::make($dto->password)
        ]);

        return $employee;
    }
}
