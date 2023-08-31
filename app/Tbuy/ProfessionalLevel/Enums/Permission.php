<?php

namespace App\Tbuy\ProfessionalLevel\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_LEVEL_LIST = 'view level list';
    case CREATE_LEVEL = 'create level';
    case UPDATE_LEVEL = 'update level';
    case DELETE_LEVEL = 'delete level';
}
