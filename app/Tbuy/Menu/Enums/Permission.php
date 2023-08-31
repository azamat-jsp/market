<?php

namespace App\Tbuy\Menu\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case MENU_SET_USER = 'menu set user';
    case VIEW_MENU = 'view menu';
    case CREATE_MENU = 'create menu';
    case UPDATE_MENU = 'update menu';
    case DELETE_MENU = 'delete menu';
}
