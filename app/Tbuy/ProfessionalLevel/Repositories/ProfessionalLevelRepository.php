<?php

namespace App\Tbuy\ProfessionalLevel\Repositories;

use App\Contracts\PaginatableContract;
use App\Tbuy\ProfessionalLevel\DTOs\ProfessionalLevelDTO;
use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use Illuminate\Database\Eloquent\Builder;

interface ProfessionalLevelRepository extends PaginatableContract
{
    public function get(): Builder;

    public function create(ProfessionalLevelDTO $vacancyTypeDTO): ProfessionalLevel;

    public function update(ProfessionalLevelDTO $payload, ProfessionalLevel $level): ProfessionalLevel;

    public function delete(ProfessionalLevel $level): void;
}
