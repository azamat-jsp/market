<?php

namespace App\Tbuy\ProfessionalLevel\Services;

use App\Tbuy\ProfessionalLevel\DTOs\ProfessionalLevelDTO;
use App\Tbuy\ProfessionalLevel\Enums\ProfessionalLevelCacheKey;
use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use App\Tbuy\ProfessionalLevel\Repositories\ProfessionalLevelRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Opcodes\LogViewer\Facades\Cache;

class ProfessionalLevelServiceImplementation implements ProfessionalLevelService
{
    public function __construct(
        private readonly ProfessionalLevelRepository $professionalLevelRepository
    ) {
    }

    public function get(): LengthAwarePaginator
    {
        $query = $this->professionalLevelRepository->get();

        return Cache::tags(ProfessionalLevelCacheKey::LIST->value)
            ->remember(
                ProfessionalLevelCacheKey::LIST->setKeys([request()->perPage]),
                ProfessionalLevelCacheKey::ttl(),
                fn () => $this->professionalLevelRepository->paginate($query, request()->perPage)
            );
    }

    public function create(ProfessionalLevelDTO $dto): ProfessionalLevel
    {
        $condition = $this->professionalLevelRepository->create($dto);

        Cache::tags(ProfessionalLevelCacheKey::LIST)->clear();

        return $condition;
    }

    public function update(ProfessionalLevelDTO $payload, ProfessionalLevel $level): ProfessionalLevel
    {
        $condition = $this->professionalLevelRepository->update($payload, $level);

        Cache::tags(ProfessionalLevelCacheKey::LIST)->clear();

        return $condition;
    }

    public function delete(ProfessionalLevel $level): void
    {
        $this->professionalLevelRepository->delete($level);

        Cache::tags(ProfessionalLevelCacheKey::LIST)->clear();
    }
}
