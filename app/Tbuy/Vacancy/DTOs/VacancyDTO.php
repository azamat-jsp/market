<?php

namespace App\Tbuy\Vacancy\DTOs;

class VacancyDTO
{
    public function __construct(
        public readonly int      $category_id,
        public readonly array    $title,
        public readonly array    $description,
        public readonly int      $salary,
        public readonly array    $images,
        public readonly int      $company_id,
        public readonly string   $address,
        public readonly string   $position,
        public readonly int   $working_conditions,
        public readonly int   $working_type,
        public readonly string   $deadline,
        public readonly ?string   $status = null,
    )
    {
    }
}
