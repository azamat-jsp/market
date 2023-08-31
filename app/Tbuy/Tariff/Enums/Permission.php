<?php

namespace App\Tbuy\Tariff\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_TARIFF_LIST = 'view tariff list';
    case CREATE_TARIFF = 'create tariff';
    case UPDATE_TARIFF = 'update tariff';
    case DELETE_TARIFF = 'delete tariff';
    case BUY_TARIFF = 'buy tariff';
    case VIEW_TARIFF_LOG = 'view tariff log';
}
