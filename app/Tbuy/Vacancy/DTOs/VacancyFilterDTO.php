<?php

namespace App\Tbuy\Vacancy\DTOs;

use App\DTOs\BaseDTO;
use App\Tbuy\Vacancy\Enums\VacancyStatus;

class VacancyFilterDTO extends BaseDTO
{
    public function __construct(
        public readonly ?VacancyStatus $status = null,
        public readonly ?int    $category_id = null,
        public readonly ?int    $page = null,
        public readonly ?int    $perPage = null,
    )
    {
    }
}
