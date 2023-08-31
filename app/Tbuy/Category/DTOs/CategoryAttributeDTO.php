<?php

namespace App\Tbuy\Category\DTOs;

use App\DTOs\BaseDTO;

class CategoryAttributeDTO extends BaseDTO
{
    public function __construct(
        public readonly array    $attributes,
        public readonly ?int    $page = null,
        public readonly ?int    $perPage = null,
    )
    {
    }
}
