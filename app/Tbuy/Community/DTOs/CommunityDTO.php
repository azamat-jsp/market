<?php

namespace App\Tbuy\Community\DTOs;

use App\DTOs\BaseDTO;

class CommunityDTO extends BaseDTO
{
    public function __construct(
        public readonly array     $name,
    )
    {
    }
}
