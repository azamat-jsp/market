<?php

namespace App\Tbuy\Attribute\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_ATTRIBUTE = 'view attribute';
    case CREATE_ATTRIBUTE = 'create attribute';
    case UPDATE_ATTRIBUTE = 'update attribute';
    case DELETE_ATTRIBUTE = 'delete attribute';
}
