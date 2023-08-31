<?php

namespace App\Tbuy\Audience\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_AUDIENCE_LIST = 'view audience list';
    case CREATE_AUDIENCE = 'create audience';
    case UPDATE_AUDIENCE = 'update audience';
    case DELETE_AUDIENCE = 'delete audience';
}
