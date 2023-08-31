<?php

namespace App\Tbuy\AttributeCategory\DTOs;

class FilterDTO
{
    public function __construct(
        public readonly ?int $perPage = null,
        public readonly int  $page = 1
    )
    {
    }
}
