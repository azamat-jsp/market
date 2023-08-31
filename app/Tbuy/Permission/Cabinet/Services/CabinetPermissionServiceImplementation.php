<?php

namespace App\Tbuy\Permission\Cabinet\Services;

use App\Tbuy\Permission\Cabinet\Enums\CabinetPages;
use App\Tbuy\Permission\Cabinet\Enums\CabinetPagesPermissions;
use App\Tbuy\Employee\Models\CompanyEmployee;
use App\Tbuy\Employee\DTOs\EmployeeDTO;
use App\Tbuy\Permission\Cabinet\Repositories\CabinetPermissionRepository;

class CabinetPermissionServiceImplementation implements CabinetPermissionService
{
    protected array $permissions;

    public function __construct(
        private readonly CabinetPermissionRepository $cabinetPermissionRepository
    ) {
        $this->permissions = config('permission.permission_group.cabinet');
    }

    public function getStructure(): array
    {
        $output = [];
        foreach ($this->permissions as $page => $pageAllows) {
            $output[$page] = array_keys($pageAllows);
        }

        return $output;
    }

    /**
     * Генерирует структуру прав кабината сотрудника с учетом имеющихся прав сотрудника
     */
    public function getStructureEmployee(CompanyEmployee $companyEmployee): array
    {
        $allPagesPermissions = $this->getAllPagesPermissions();
        $employeePermissions = $this->cabinetPermissionRepository->getEmployeePermissionPage($companyEmployee, $allPagesPermissions)->pluck('name')->toArray();

        return $this->generateStructureEmployee($employeePermissions);
    }

    public function getPermissionPageByRequest(array $permissions): array
    {
        $pagesPermissions = [];

        foreach ($permissions as $page) {
            $pagesPermissions = match ($page['can']) {
                CabinetPagesPermissions::CAN_ALL->value => array_merge(
                    $pagesPermissions,
                    $this->permissions[$page['key']][CabinetPagesPermissions::CAN_EDIT->value],
                    $this->permissions[$page['key']][CabinetPagesPermissions::CAN_VIEW->value]
                ),
                CabinetPagesPermissions::CAN_EDIT->value, CabinetPagesPermissions::CAN_VIEW->value =>
                array_merge($pagesPermissions, $this->permissions[$page['key']][$page['can']]),
            };
        }
        $pagesPermissions =  array_column($pagesPermissions, 'value');
        return $this->cabinetPermissionRepository->getPermissionsPage($pagesPermissions)->pluck('id')->toArray();
    }

    /**
     * Собирает список всех пермишеннов для кабината сотрудника
     */
    private function getAllPagesPermissions(): array
    {
        $allPagesPermissions = [];

        foreach ($this->permissions as $pageAllows) {
            $allPagesPermissions = array_merge($allPagesPermissions, array_column($pageAllows[CabinetPagesPermissions::CAN_EDIT->value], 'value'));
            $allPagesPermissions = array_merge($allPagesPermissions, array_column($pageAllows[CabinetPagesPermissions::CAN_VIEW->value], 'value'));
        }
        return $allPagesPermissions;
    }

    private function generateStructureEmployee(array $employeePermissions): array
    {
        $output = [];

        foreach ($this->permissions as $page => $pageAllows) {
            $permissionsEdit = array_column($pageAllows[CabinetPagesPermissions::CAN_EDIT->value], 'value');
            $permissionsView = array_column($pageAllows[CabinetPagesPermissions::CAN_VIEW->value], 'value');

            $countEditPermissions = count(array_intersect($permissionsEdit, $employeePermissions));
            $countViewPermissions = count(array_intersect($permissionsView, $employeePermissions));
            $isPermissionEdit = sizeof($permissionsEdit) === $countEditPermissions && $countEditPermissions !== 0;
            $isPermissionView = sizeof($permissionsView) === $countViewPermissions && $countViewPermissions !== 0;

            $isCanAll = $isPermissionEdit && $isPermissionView;
            $output[$page][CabinetPagesPermissions::CAN_ALL->value] = $isCanAll;
            $output[$page][CabinetPagesPermissions::CAN_EDIT->value] = $isCanAll ? false : $isPermissionEdit;
            $output[$page][CabinetPagesPermissions::CAN_VIEW->value] = $isCanAll ? false : $isPermissionView;
        }

        return $output;
    }
}
