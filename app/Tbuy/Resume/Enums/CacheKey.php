<?php

namespace App\Tbuy\Resume\Enums;

use App\Traits\SetKeys;

enum CacheKey: string
{
    use SetKeys;

    case BANNER_TAG = 'resume-tag';
    case LIST = 'list';

    public static function ttl(): int
    {
        return 3600 * 24;
    }
}
