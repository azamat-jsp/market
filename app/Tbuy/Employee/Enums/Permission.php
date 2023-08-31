<?php

namespace App\Tbuy\Employee\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case ViEW_COMPANY_EMPLOYEE = 'view company employee';
    case STORE_COMPANY_EMPLOYEE = 'store company employee';
    case SHOW_COMPANY_EMPLOYEE = 'show company employee';
    case UPDATE_COMPANY_EMPLOYEE = 'update company employee';
    case DELETE_COMPANY_EMPLOYEE = 'delete company employee';
    case VIEW_PERMISSIONS_EMPLOYEE = 'view permissions employee';
}
