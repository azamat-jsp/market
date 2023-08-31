<?php

namespace App\Tbuy\User\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_ANY = 'view any';
    case VIEW_USER = 'view user';
    case STORE_USER = 'store user';
    case SHOW_USER = 'show user';
    case UPDATE_USER = 'update user';
    case DELETE_USER = 'delete user';
}
