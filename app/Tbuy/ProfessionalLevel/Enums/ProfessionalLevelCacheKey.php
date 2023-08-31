<?php

namespace App\Tbuy\ProfessionalLevel\Enums;

use App\Traits\SetKeys;

enum ProfessionalLevelCacheKey: string
{
    use SetKeys;

    case LIST = 'professional-level-list';

    public static function ttl(): int
    {
        return 3_600 * 24; // 24 hours
    }
}
