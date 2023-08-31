<?php

namespace App\Tbuy\Community\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_COMMUNITY_LIST = 'view community list';
    case SHOW_COMMUNITY = 'show community';
    case STORE_COMMUNITY = 'store community';
    case UPDATE_COMMUNITY = 'update community';
    case DELETE_COMMUNITY = 'delete community';

}
