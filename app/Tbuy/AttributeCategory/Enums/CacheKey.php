<?php

namespace App\Tbuy\AttributeCategory\Enums;

use App\Traits\SetKeys;

enum CacheKey: string
{
    use SetKeys;

    case TAG_NAME = 'attribute-category-tag';

    case LIST = 'list';

    public static function ttl(): int
    {
        return 3600 * 24;
    }
}
