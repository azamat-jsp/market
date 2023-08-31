<?php

namespace App\Tbuy\Filial\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Company\Enums\CompanyStatus;

class FilialFilterDTO extends BaseDTO
{
    public function __construct(
        public readonly ?int $company_id = null,
        public readonly ?string $from = null,
        public readonly ?string $to = null,
        public readonly ?int $page = null,
        public readonly ?int $perPage = null
    )
    {
    }
}
