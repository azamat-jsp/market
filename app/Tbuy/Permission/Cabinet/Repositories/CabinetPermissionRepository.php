<?php

namespace App\Tbuy\Permission\Cabinet\Repositories;

use App\Tbuy\Employee\Models\CompanyEmployee;
use Illuminate\Database\Eloquent\Collection;

interface CabinetPermissionRepository
{
    public function getEmployeePermissionPage(CompanyEmployee $companyEmployee, $permissions): Collection;

    public function getPermissionsPage($permissions): Collection;
}
