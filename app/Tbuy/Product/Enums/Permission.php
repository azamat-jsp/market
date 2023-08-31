<?php

namespace App\Tbuy\Product\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_PRODUCT_LIST = 'view product list';
    case VIEW_REJECTED_PRODUCT_LIST = 'view rejected product list';
    case VIEW_ZERO_AMOUNT_PRODUCT_LIST = 'view zero amount product list';
    case STORE_PRODUCT = 'store product';
    case UPDATE_PRODUCT = 'update product';
    case TOGGLE_PRODUCT_STATUS = 'toggle product status';
    case SET_PRODUCT_ATTRIBUTE = 'set product attribute';
    case STORE_PRODUCT_VISIBLE_FIELDS = 'store product visible fields';
    case VIEW_PRODUCT_VISIBLE_FIELDS = 'view product visible fields';
    case EXTEND_PRODUCT_NAME = 'extend product name';
}
