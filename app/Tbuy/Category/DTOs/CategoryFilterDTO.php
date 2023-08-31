<?php

namespace App\Tbuy\Category\DTOs;

use App\DTOs\BaseDTO;

class CategoryFilterDTO extends BaseDTO
{
    public function __construct(
        public readonly ?string    $type = null,
        public readonly ?int    $page = null,
        public readonly ?int    $perPage = null
    )
    {
    }
}
