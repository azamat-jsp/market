<?php

namespace App\Tbuy\Community\Enums;

use App\Traits\SetKeys;

enum CacheKey: string
{
    use SetKeys;

    case COMMUNITY_LIST = 'community-list';

    case COMMUNITY_TAG = 'community-tag';

    public static function ttl(): int
    {
        return 3_600 * 24; // 24 hours
    }
}
