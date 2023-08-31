<?php

namespace App\Tbuy\Question\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case STORE_QUESTION = 'store question';
    case UPDATE_QUESTION = 'update question';
    case DELETE_QUESTION = 'delete question';
}
