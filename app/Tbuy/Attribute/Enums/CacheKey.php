<?php

namespace App\Tbuy\Attribute\Enums;

use App\Traits\SetKeys;

enum CacheKey: string
{
    use SetKeys;

    case TAG_NAME = 'attribute-tag';

    case LIST = 'list';

    public static function ttl(): int
    {
        return 3600 * 24;
    }
}
