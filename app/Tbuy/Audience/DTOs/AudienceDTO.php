<?php

namespace App\Tbuy\Audience\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Audience\Enums\Gender;

class AudienceDTO extends BaseDTO
{
    public function __construct(
        public readonly array  $name,
        public readonly int    $company_id,
        public readonly int    $country_id,
        public readonly int    $region_id,
        public readonly Gender $gender,
        public readonly array  $age,
    )
    {
    }
}
