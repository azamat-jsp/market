<?php

namespace App\Tbuy\Vacancy\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_VACANCY_LIST = 'view vacancy list';
    case CREATE_VACANCY = 'create vacancy';
    case UPDATE_VACANCY = 'update vacancy';
    case DELETE_VACANCY = 'delete vacancy';
    case TOGGLE_STATUS_VACANCY = 'toggle status vacancy';

    case VIEW_VACANCY_CATEGORY_LIST = 'view vacancy category list';
    case CREATE_VACANCY_CATEGORY = 'create vacancy category';
    case UPDATE_VACANCY_CATEGORY = 'update vacancy category';
    case DELETE_VACANCY_CATEGORY = 'delete vacancy category';
}
