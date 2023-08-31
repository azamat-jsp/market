<?php

namespace App\Tbuy\Target\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_TARGET_LIST = 'view target list';
    case CREATE_TARGET = 'create target';
    case UPDATE_TARGET = 'update target';
    case DELETE_TARGET = 'delete target';
    case CHANGE_TARGET_STATUS = 'change target status';
}
