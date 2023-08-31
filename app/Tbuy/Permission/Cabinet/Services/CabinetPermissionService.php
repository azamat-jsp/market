<?php

namespace App\Tbuy\Permission\Cabinet\Services;

use App\Tbuy\Employee\Models\CompanyEmployee;

interface CabinetPermissionService
{
    public function getStructure(): array;

    public function getStructureEmployee(CompanyEmployee $companyEmployee): array;

    public function getPermissionPageByRequest(array $permissions): array;
}
