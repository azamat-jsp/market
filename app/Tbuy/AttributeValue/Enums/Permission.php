<?php

namespace App\Tbuy\AttributeValue\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_ATTRIBUTE_VALUE = 'view attribute value';
    case CREATE_ATTRIBUTE_VALUE = 'create attribute value';
    case UPDATE_ATTRIBUTE_VALUE = 'update attribute value';
    case DELETE_ATTRIBUTE_VALUE = 'delete attribute value';
    case BRAND_ATTACH_CATEGORY = 'brand attach category';
}
