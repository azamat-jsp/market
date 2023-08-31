<?php

namespace App\Tbuy\Region\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case STORE_REGION = 'store region';
    case UPDATE_REGION = 'update region';
    case DELETE_REGION = 'delete region';
}
