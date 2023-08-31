<?php

namespace App\Tbuy\Invite\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case INVITE_CREATE = 'invite create';
    case INVITE_ACTIVATE = 'invite activate';
}
