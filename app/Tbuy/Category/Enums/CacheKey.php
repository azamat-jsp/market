<?php

namespace App\Tbuy\Category\Enums;

use App\Traits\SetKeys;

enum CacheKey: string
{
    use SetKeys;
    case TAG_NAME = 'category-tag';

    case LIST = 'list';

    public static function ttl(): int
    {
        return 3600 * 24;
    }
}
