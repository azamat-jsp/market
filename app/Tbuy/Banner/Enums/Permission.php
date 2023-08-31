<?php

namespace App\Tbuy\Banner\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_BANNER = 'view banner';
    case CREATE_BANNER = 'create banner';
    case UPDATE_BANNER = 'update banner';
    case DELETE_BANNER = 'delete banner';
}
