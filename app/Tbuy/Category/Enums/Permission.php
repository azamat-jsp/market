<?php

namespace App\Tbuy\Category\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_CATEGORY = 'view category';
    case STORE_CATEGORY = 'store category';
    case SHOW_CATEGORY = 'show category';
    case UPDATE_CATEGORY = 'update category';
    case DELETE_CATEGORY = 'delete category';
    case RATIO_CATEGORY = 'ratio category';
    case SWITCH_STATUS_CATEGORY = 'switch status category';
    case SHOW_CATEGORY_PRODUCTS = 'show category products';
}
