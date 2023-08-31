<?php

namespace App\Tbuy\Vacancy\DTOs\Client;

class VacancyDTO
{
    public function __construct(
        public readonly array    $title,
        public readonly array    $description,
        public readonly int      $salary,
        public readonly int      $category_id,
        public readonly string   $address,
        public readonly string   $position,
        public readonly int   $working_conditions,
        public readonly int   $working_type,
        public readonly string   $deadline,
    )
    {
    }
}
