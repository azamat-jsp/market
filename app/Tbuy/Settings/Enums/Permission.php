<?php

namespace App\Tbuy\Settings\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_SETTINGS = 'view settings';
    case SHOW_SETTINGS = 'show settings';
    case UPDATE_SETTINGS = 'update settings';
}
