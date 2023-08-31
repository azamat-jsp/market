<?php

namespace App\Tbuy\Locale\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_LOCALE = 'view locale';
    case UPDATE_LOCALE = 'update locale';
    case CREATE_LOCALE = 'create locale';
    case DELETE_LOCALE = 'delete locale';
}
