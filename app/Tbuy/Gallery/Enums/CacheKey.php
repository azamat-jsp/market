<?php

namespace App\Tbuy\Gallery\Enums;

use App\Traits\SetKeys;

enum CacheKey: string
{
    use SetKeys;

    case GALLERY_TAG = 'gallery-tag';
    case LIST = 'list';

    public static function ttl(): int
    {
        return 3600 * 24; // 24 hours
    }
}
