<?php

namespace App\Tbuy\Permission\Cabinet\Repositories;

use App\Tbuy\Employee\Models\CompanyEmployee;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class CabinetPermissionRepositoryImplementation implements CabinetPermissionRepository
{
    public function getEmployeePermissionPage(CompanyEmployee $companyEmployee, $permissions): Collection
    {
        $permissionIds = Permission::query()->whereIn('name', $permissions)->pluck('id');
        return $companyEmployee->user->permissions()->whereIn('id', $permissionIds)->get();
    }

    public function getPermissionsPage($permissions): Collection
    {
        return Permission::query()->whereIn('name', $permissions)->get();
    }
}
