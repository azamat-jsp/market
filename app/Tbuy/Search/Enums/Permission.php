<?php

namespace App\Tbuy\Search\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_SEARCHABLE_FIELD = 'view searchable field';
    case STORE_SEARCHABLE_FIELD = 'store searchable field';
    case SHOW_SEARCHABLE_FIELD = 'show searchable field';
    case UPDATE_SEARCHABLE_FIELD = 'update searchable field';
    case DELETE_SEARCHABLE_FIELD = 'delete searchable field';

    case VIEW_SEARCHABLE_MODEL = 'view searchable model';
    case STORE_SEARCHABLE_MODEL = 'store searchable model';
    case SHOW_SEARCHABLE_MODEL = 'show searchable model';
    case UPDATE_SEARCHABLE_MODEL = 'update searchable model';
    case DELETE_SEARCHABLE_MODEL = 'delete searchable model';
}
