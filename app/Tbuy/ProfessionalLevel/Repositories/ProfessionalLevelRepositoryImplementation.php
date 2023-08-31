<?php

namespace App\Tbuy\ProfessionalLevel\Repositories;

use App\Tbuy\ProfessionalLevel\DTOs\ProfessionalLevelDTO;
use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfessionalLevelRepositoryImplementation implements ProfessionalLevelRepository
{
    use HasPaginate;

    public function get(): Builder
    {
        return ProfessionalLevel::query();
    }

    public function create(ProfessionalLevelDTO $professionalLevelDTO): ProfessionalLevel
    {
        $level = new ProfessionalLevel();

        $level = $this->addTranslations($professionalLevelDTO, $level);
        $level->save();

        return $level;
    }

    public function update(ProfessionalLevelDTO $payload, ProfessionalLevel $level): ProfessionalLevel
    {
        $level = $this->addTranslations($payload, $level);
        $level->save();

        return $level;
    }

    public function delete(ProfessionalLevel $level): void
    {
        $level->delete();
    }

    protected function addTranslations(ProfessionalLevelDTO $payload, ProfessionalLevel $level): ProfessionalLevel
    {
        return $level->setTranslations('name', $payload->name);
    }
}
