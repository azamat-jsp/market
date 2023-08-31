<?php

namespace App\Tbuy\Audience\Enums;

use Illuminate\Support\Traits\EnumeratesValues;

enum Gender: string
{
    case MALE = 'm';
    case FEMALE = 'f';
    case ALL = 'all';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
