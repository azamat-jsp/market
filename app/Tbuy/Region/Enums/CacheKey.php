<?php

namespace App\Tbuy\Region\Enums;

enum CacheKey: string
{
    case REGION_LIST = 'region-list';

    public static function ttl(): int
    {
        return 3600 * 24; // 24 hours
    }
}
