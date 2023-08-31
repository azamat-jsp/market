<?php

namespace App\Tbuy\Search\DTOs;

use App\DTOs\BaseDTO;

class SearchableFieldDTO extends BaseDTO
{
    public function __construct(
        public readonly int $priority,
        public readonly bool $is_enabled,
    )
    {
    }
}
