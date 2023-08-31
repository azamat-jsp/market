<?php

namespace App\Tbuy\Filial\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_COMPANY_FILIAL = 'view company filial';
    case CREATE_COMPANY_FILIAL = 'create company filial';
    case UPDATE_COMPANY_FILIAL = 'edit company filial';
    case DELETE_COMPANY_FILIAL = 'delete company filial';
    case VIEW_ALL_FILIAL = 'view all filial';
}
