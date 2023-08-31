<?php

namespace App\Tbuy\Permission\Cabinet\Enums;

enum CabinetPagesPermissions: string
{
    case CAN_VIEW = 'can_view';
    case CAN_EDIT = 'can_edit';
    case CAN_ALL = 'can_all';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
