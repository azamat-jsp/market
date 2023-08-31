<?php

namespace App\Tbuy\Resume\DTOs;

use App\DTOs\BaseDTO;

class ResumeFilterDTO extends BaseDTO
{
    public function __construct(
        public readonly ?int $category_id = null,
        public readonly ?int $page = null,
        public readonly ?int $perPage = null,
    )
    {
    }
}
