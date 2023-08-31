<?php

namespace App\Tbuy\AttributeCategory\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;
    case VIEW_ATTRIBUTE_CATEGORY = 'view attribute category';
    case CREATE_ATTRIBUTE_CATEGORY = 'create attribute category';
    case UPDATE_ATTRIBUTE_CATEGORY = 'update attribute category';
    case DELETE_ATTRIBUTE_CATEGORY = 'delete attribute category';
}
