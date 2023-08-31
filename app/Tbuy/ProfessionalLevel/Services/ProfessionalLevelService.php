<?php

namespace App\Tbuy\ProfessionalLevel\Services;

use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use App\Tbuy\ProfessionalLevel\DTOs\ProfessionalLevelDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProfessionalLevelService
{
    public function get(): LengthAwarePaginator;

    public function create(ProfessionalLevelDTO $dto): ProfessionalLevel;

    public function update(ProfessionalLevelDTO $payload, ProfessionalLevel $level): ProfessionalLevel;

    public function delete(ProfessionalLevel $level): void;
}
