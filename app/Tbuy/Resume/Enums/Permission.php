<?php

namespace App\Tbuy\Resume\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case RESUME_STORE = 'resume store';
    case RESUME_FAVORITE_STORE = 'resume favorite store';
    case RESUME_FAVORITE_GET = 'resume favorite get';
    case RESUME_LIST = 'resume list';
    case FEEDBACK_ON_VACANCY = 'feedback on vacancy';
}
