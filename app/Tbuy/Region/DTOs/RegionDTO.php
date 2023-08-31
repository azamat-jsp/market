<?php

namespace App\Tbuy\Region\DTOs;

use App\DTOs\BaseDTO;

class RegionDTO extends BaseDTO
{
    public function __construct(
        public readonly array $name,
        public readonly int   $country_id,
        public readonly int   $user_id,
    )
    {
    }
}
