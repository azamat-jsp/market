<?php

namespace App\Tbuy\Gallery\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_COMPANY_GALLERIES = 'view company galleries';
    case CREATE_COMPANY_GALLERY = 'create company gallery';
    case UPDATE_COMPANY_GALLERY = 'edit company gallery';
    case DELETE_COMPANY_GALLERY = 'delete company gallery';
}
