<?php

namespace App\Tbuy\Rejection\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_REJECTIONS = 'view rejections';
    case UPDATE_REJECTION = 'update rejections';
}
