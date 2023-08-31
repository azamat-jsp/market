<?php

namespace App\Tbuy\Attribute\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Attribute\Enums\AttributeType;

class AttributeDTO extends BaseDTO
{
    public function __construct(
        public readonly array         $name,
        public readonly AttributeType $type,
    )
    {
    }
}
