<?php

namespace App\Tbuy\Brand\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_BRAND = 'view brand';
    case CREATE_BRAND = 'create brand';
    case UPDATE_BRAND = 'update brand';
    case DELETE_BRAND = 'delete brand';
    case BRAND_ATTACH_PRODUCT = 'attach brand product';
    case BRAND_STATUS_EDIT = 'status update brand';
    case SET_BRAND_ATTRIBUTE = 'set brand attribute';
    case SUBSCRIBE_BRAND = 'subscribe brand';
    case UNSUBSCRIBE_BRAND = 'unsubscribe brand';
    case BRAND_ATTACH_CATEGORY = 'attach brand category';
}
